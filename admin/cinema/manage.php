<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$result = $conn->query("SELECT * FROM cinema_posts ORDER BY created_at DESC");
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Cinema Content - Admin</title>
  <style>
    /* Reset and base styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      min-height: 100vh;
      background: linear-gradient(135deg, #f6f1e7 0%, #f0e6d6 100%);
      padding: 20px;
      color: #2c1810;
    }
    
    /* Main container */
    .dashboard-container {
      max-width: 1400px;
      margin: 0 auto;
    }
    
    /* Header */
    .header {
      background: linear-gradient(135deg, #4b2e1e 0%, #2c1810 100%);
      color: white;
      padding: 25px 30px;
      border-radius: 15px;
      margin-bottom: 30px;
      box-shadow: 0 8px 25px rgba(75, 46, 30, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .header h1 {
      color: white;
      margin: 0;
      font-size: 28px;
      display: flex;
      align-items: center;
    }
    
    .header h1:before {
      content: "🎬";
      margin-right: 15px;
      font-size: 32px;
    }
    
    /* Stats badge */
    .stats-badge {
      background: rgba(255, 255, 255, 0.2);
      padding: 8px 20px;
      border-radius: 20px;
      font-size: 14px;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    /* Navigation */
    .navigation {
      background: #ffffff;
      padding: 18px 25px;
      border-radius: 12px;
      margin-bottom: 25px;
      box-shadow: 0 4px 15px rgba(75, 46, 30, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    
    .nav-links a {
      display: inline-flex;
      align-items: center;
      padding: 10px 18px;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-weight: 600;
      background: #f8f4ef;
      color: #4b2e1e;
      text-decoration: none;
      margin-right: 10px;
      border: 1px solid rgba(75, 46, 30, 0.1);
      font-size: 14px;
    }
    
    .nav-links a:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(75, 46, 30, 0.1);
      background: #d4a762;
      color: #2c1810;
    }
    
    .page-actions {
      display: flex;
      gap: 10px;
    }
    
    .btn {
      padding: 10px 20px;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      border: none;
      cursor: pointer;
      font-size: 14px;
    }
    
    .btn-primary {
      background: #4b2e1e;
      color: white;
    }
    
    .btn-primary:hover {
      background: #2c1810;
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(75, 46, 30, 0.2);
    }
    
    /* Main content card */
    .content-card {
      background: #ffffff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 10px 30px rgba(75, 46, 30, 0.1);
      overflow: hidden;
    }
    
    .content-card h2 {
      color: #4b2e1e;
      font-size: 24px;
      margin-bottom: 25px;
      padding-bottom: 15px;
      border-bottom: 2px solid #d4a762;
      display: flex;
      align-items: center;
    }
    
    .content-card h2:before {
      content: "📋";
      margin-right: 12px;
      font-size: 24px;
    }
    
    /* Enhanced table styling */
    .cinema-table-container {
      overflow-x: auto;
      border-radius: 10px;
      border: 1px solid rgba(75, 46, 30, 0.15);
      -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }
    
    .cinema-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }
    
    .cinema-table thead {
      background: linear-gradient(135deg, #4b2e1e 0%, #2c1810 100%);
    }
    
    .cinema-table th {
      color: white;
      font-weight: 600;
      text-align: left;
      padding: 18px 20px;
      font-size: 15px;
      border: none;
      position: relative;
      white-space: nowrap;
    }
    
    .cinema-table th:after {
      content: '';
      position: absolute;
      right: 0;
      top: 20%;
      height: 60%;
      width: 1px;
      background: rgba(255, 255, 255, 0.3);
    }
    
    .cinema-table th:last-child:after {
      display: none;
    }
    
    .cinema-table tbody tr {
      background: white;
      transition: all 0.3s ease;
      border-bottom: 1px solid rgba(75, 46, 30, 0.15);
    }
    
    .cinema-table tbody tr:nth-child(even) {
      background: #f8f4ef;
    }
    
    .cinema-table tbody tr:hover {
      background: rgba(212, 167, 98, 0.1);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(75, 46, 30, 0.1);
      z-index: 1;
      position: relative;
    }
    
    .cinema-table td {
      padding: 20px;
      color: #444;
      border: none;
      vertical-align: middle;
    }
    
    /* Image cell styling */
    .cinema-image {
      width: 100px;
      height: 70px;
      object-fit: cover;
      border-radius: 8px;
      border: 2px solid white;
      box-shadow: 0 3px 10px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
    }
    
    .cinema-image:hover {
      transform: scale(1.8);
      z-index: 10;
      position: relative;
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
    }
    
    /* Title cell styling */
    .cinema-title {
      font-weight: 600;
      color: #4b2e1e;
      margin-bottom: 5px;
      line-height: 1.4;
      font-size: 16px;
    }
    
    .cinema-meta {
      font-size: 12px;
      color: #888;
      display: flex;
      align-items: center;
      gap: 10px;
      margin-top: 8px;
      flex-wrap: wrap;
    }
    
    /* Label cell styling */
    .cinema-label {
      display: inline-flex;
      align-items: center;
      padding: 6px 12px;
      border-radius: 20px;
      font-size: 12px;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      white-space: nowrap;
    }
    
    .label-actor {
      background: rgba(255, 193, 7, 0.1);
      color: #ffc107;
      border: 1px solid rgba(255, 193, 7, 0.2);
    }
    
    .label-movie {
      background: rgba(13, 110, 253, 0.1);
      color: #0d6efd;
      border: 1px solid rgba(13, 110, 253, 0.2);
    }
    
    .label-song {
      background: rgba(111, 66, 193, 0.1);
      color: #6f42c1;
      border: 1px solid rgba(111, 66, 193, 0.2);
    }
    
    .label-memory {
      background: rgba(32, 201, 151, 0.1);
      color: #20c997;
      border: 1px solid rgba(32, 201, 151, 0.2);
    }
    
    /* Action cell styling */
    .action-buttons {
      display: flex;
      gap: 10px;
      flex-wrap: wrap;
    }
    
    .action-btn {
      padding: 8px 16px;
      border-radius: 6px;
      font-weight: 600;
      text-decoration: none;
      font-size: 13px;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      border: 1px solid transparent;
      min-height: 36px;
    }
    
    .action-btn-edit {
      background: rgba(40, 167, 69, 0.1);
      color: #28a745;
      border-color: rgba(40, 167, 69, 0.2);
    }
    
    .action-btn-edit:hover {
      background: #28a745;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(40, 167, 69, 0.2);
    }
    
    .action-btn-delete {
      background: rgba(220, 53, 69, 0.1);
      color: #dc3545;
      border-color: rgba(220, 53, 69, 0.2);
    }
    
    .action-btn-delete:hover {
      background: #dc3545;
      color: white;
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(220, 53, 69, 0.2);
    }
    
    /* Empty state styling */
    .empty-state {
      text-align: center;
      padding: 60px 20px;
    }
    
    .empty-icon {
      font-size: 64px;
      margin-bottom: 20px;
      opacity: 0.5;
    }
    
    .empty-state h3 {
      color: #4b2e1e;
      margin-bottom: 10px;
      font-size: 22px;
    }
    
    .empty-state p {
      color: #666;
      margin-bottom: 25px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.6;
    }
    
    /* Table controls */
    .table-controls {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      gap: 15px;
      flex-wrap: wrap;
    }
    
    .search-box {
      flex: 1;
      min-width: 250px;
      max-width: 400px;
      position: relative;
    }
    
    .search-input {
      width: 100%;
      padding: 12px 20px 12px 45px;
      border: 2px solid rgba(75, 46, 30, 0.15);
      border-radius: 10px;
      font-size: 14px;
      transition: all 0.3s ease;
      background: white;
    }
    
    .search-input:focus {
      outline: none;
      border-color: #d4a762;
      box-shadow: 0 0 0 3px rgba(212, 167, 98, 0.2);
    }
    
    .search-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: #999;
      font-size: 18px;
    }
    
    .stats-summary {
      font-size: 14px;
      color: #666;
      background: rgba(75, 46, 30, 0.05);
      padding: 8px 15px;
      border-radius: 6px;
      white-space: nowrap;
    }
    
    /* Filter buttons */
    .filter-buttons {
      display: flex;
      gap: 10px;
      margin-bottom: 20px;
      flex-wrap: wrap;
    }
    
    .filter-btn {
      padding: 8px 16px;
      border-radius: 20px;
      font-size: 13px;
      font-weight: 600;
      background: #f8f9fa;
      border: 1px solid #dee2e6;
      color: #495057;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      white-space: nowrap;
    }
    
    .filter-btn:hover {
      background: #e9ecef;
      transform: translateY(-2px);
    }
    
    .filter-btn.active {
      background: #4b2e1e;
      color: white;
      border-color: #4b2e1e;
    }
    
    .filter-btn:before {
      font-size: 14px;
    }
    
    /* Mobile Card View */
    .mobile-cinema-list {
      display: none;
    }
    
    .cinema-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(75, 46, 30, 0.1);
      border: 1px solid rgba(75, 46, 30, 0.1);
    }
    
    .cinema-card-header {
      display: flex;
      gap: 15px;
      margin-bottom: 15px;
      align-items: flex-start;
    }
    
    .cinema-card-image {
      width: 80px;
      height: 60px;
      object-fit: cover;
      border-radius: 8px;
      border: 2px solid white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .cinema-card-content {
      flex: 1;
    }
    
    .cinema-card-title {
      font-weight: 600;
      color: #4b2e1e;
      margin-bottom: 8px;
      font-size: 16px;
      line-height: 1.4;
    }
    
    .cinema-card-meta {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 11px;
      color: #888;
      flex-wrap: wrap;
    }
    
    .cinema-card-preview {
      font-size: 13px;
      color: #666;
      line-height: 1.5;
      margin-bottom: 15px;
      padding: 10px;
      background: #f8f4ef;
      border-radius: 6px;
      max-height: 80px;
      overflow: hidden;
      position: relative;
    }
    
    .cinema-card-preview:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 20px;
      background: linear-gradient(to bottom, transparent, #f8f4ef);
    }
    
    .cinema-card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid rgba(75, 46, 30, 0.1);
      padding-top: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .cinema-card-category {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 600;
    }
    
    .cinema-card-actions {
      display: flex;
      gap: 8px;
    }
    
    /* ===== RESPONSIVE ENHANCEMENTS ===== */
    
    /* Large devices (desktops, 992px to 1199px) */
    @media (max-width: 1199px) and (min-width: 992px) {
      .dashboard-container {
        max-width: 100%;
        padding: 0 20px;
      }
      
      .content-card {
        padding: 25px;
      }
      
      .cinema-table th,
      .cinema-table td {
        padding: 15px;
      }
    }
    
    /* Medium devices (tablets, 768px to 991px) */
    @media (max-width: 991px) and (min-width: 768px) {
      .header {
        flex-direction: column;
        text-align: center;
        gap: 15px;
        padding: 22px;
      }
      
      .navigation {
        flex-direction: column;
        gap: 15px;
        text-align: center;
        padding: 16px 20px;
      }
      
      .nav-links {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 8px;
        width: 100%;
      }
      
      .nav-links a {
        margin-right: 0;
        flex: 1;
        min-width: 130px;
        padding: 9px 15px;
        font-size: 13px;
        justify-content: center;
        text-align: center;
      }
      
      .page-actions {
        width: 100%;
        justify-content: center;
      }
      
      .btn {
        padding: 10px 18px;
        font-size: 14px;
      }
      
      .content-card {
        padding: 25px;
        border-radius: 12px;
      }
      
      .content-card h2 {
        font-size: 22px;
        margin-bottom: 20px;
      }
      
      .table-controls {
        flex-direction: column;
        align-items: stretch;
        gap: 12px;
      }
      
      .search-box {
        max-width: 100%;
      }
      
      .stats-summary {
        text-align: center;
        white-space: normal;
      }
      
      .filter-buttons {
        justify-content: center;
      }
      
      .filter-btn {
        padding: 7px 14px;
        font-size: 12px;
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 8px;
      }
      
      .action-btn {
        width: 100%;
        justify-content: center;
        padding: 8px 12px;
        font-size: 12px;
      }
      
      .cinema-image {
        width: 80px;
        height: 60px;
      }
    }
    
    /* Small devices (landscape phones, 576px to 767px) */
    @media (max-width: 767px) and (min-width: 576px) {
      body {
        padding: 15px;
      }
      
      .dashboard-container {
        padding: 0 15px;
      }
      
      .header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 20px;
        border-radius: 12px;
      }
      
      .header h1 {
        font-size: 24px;
        flex-direction: column;
        gap: 8px;
      }
      
      .header h1:before {
        margin-right: 0;
        margin-bottom: 5px;
        font-size: 28px;
      }
      
      .stats-badge {
        font-size: 13px;
        padding: 6px 15px;
      }
      
      .navigation {
        flex-direction: column;
        gap: 12px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
      }
      
      .nav-links {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        width: 100%;
        margin-bottom: 10px;
      }
      
      .nav-links a {
        margin-right: 0;
        padding: 9px 12px;
        font-size: 13px;
        justify-content: center;
        text-align: center;
      }
      
      .page-actions {
        width: 100%;
      }
      
      .btn {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        justify-content: center;
      }
      
      .content-card {
        padding: 22px;
        border-radius: 12px;
      }
      
      .content-card h2 {
        font-size: 20px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
      }
      
      .content-card h2:before {
        margin-right: 0;
        font-size: 22px;
        margin-bottom: 5px;
      }
      
      .table-controls {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
      }
      
      .search-input {
        padding: 11px 16px 11px 40px;
        font-size: 13px;
        border-radius: 8px;
      }
      
      .search-icon {
        left: 12px;
        font-size: 16px;
      }
      
      .stats-summary {
        font-size: 13px;
        text-align: center;
        padding: 7px 12px;
        white-space: normal;
      }
      
      .filter-buttons {
        justify-content: center;
        gap: 8px;
      }
      
      .filter-btn {
        padding: 6px 12px;
        font-size: 12px;
        flex: 1;
        min-width: 90px;
        justify-content: center;
      }
      
      /* Show mobile card view, hide table */
      .cinema-table-container {
        display: none;
      }
      
      .mobile-cinema-list {
        display: block;
      }
      
      .cinema-card {
        padding: 18px;
        margin-bottom: 12px;
      }
      
      .cinema-card-header {
        margin-bottom: 12px;
      }
      
      .cinema-card-image {
        width: 70px;
        height: 50px;
      }
      
      .cinema-card-title {
        font-size: 15px;
      }
      
      .cinema-card-meta {
        font-size: 10px;
      }
      
      .cinema-card-preview {
        font-size: 13px;
        padding: 8px;
        margin-bottom: 12px;
        max-height: 70px;
      }
      
      .cinema-card-footer {
        padding-top: 12px;
      }
      
      .cinema-card-category {
        font-size: 11px;
      }
      
      .cinema-card-actions {
        width: 100%;
        justify-content: space-between;
      }
      
      .action-btn {
        flex: 1;
        justify-content: center;
        padding: 9px 12px;
        font-size: 13px;
      }
      
      .empty-state {
        padding: 40px 20px;
      }
      
      .empty-icon {
        font-size: 48px;
      }
      
      .empty-state h3 {
        font-size: 20px;
      }
      
      .empty-state p {
        font-size: 14px;
      }
    }
    
    /* Extra small devices (phones, 575px and down) */
    @media (max-width: 575px) {
      body {
        padding: 10px;
        font-size: 14px;
      }
      
      .dashboard-container {
        padding: 0;
        width: 100%;
      }
      
      .header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
        padding: 18px 15px;
        border-radius: 12px;
        margin-bottom: 20px;
      }
      
      .header h1 {
        font-size: 20px;
        flex-direction: column;
        gap: 10px;
      }
      
      .header h1:before {
        margin-right: 0;
        font-size: 26px;
        margin-bottom: 5px;
      }
      
      .stats-badge {
        font-size: 12px;
        padding: 6px 12px;
        justify-content: center;
      }
      
      .navigation {
        flex-direction: column;
        gap: 12px;
        text-align: center;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
      }
      
      .nav-links {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 8px;
        width: 100%;
        margin-bottom: 10px;
      }
      
      .nav-links a {
        margin-right: 0;
        padding: 8px 10px;
        font-size: 12px;
        justify-content: center;
        min-height: 40px;
        word-break: break-word;
      }
      
      .page-actions {
        width: 100%;
      }
      
      .btn {
        width: 100%;
        padding: 12px;
        font-size: 14px;
        justify-content: center;
        min-height: 44px;
      }
      
      .content-card {
        padding: 18px;
        border-radius: 10px;
        margin: 0 auto;
        width: 100%;
        box-shadow: 0 6px 15px rgba(75, 46, 30, 0.1);
      }
      
      .content-card h2 {
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 12px;
        flex-direction: column;
        text-align: center;
        gap: 8px;
      }
      
      .content-card h2:before {
        margin-right: 0;
        font-size: 22px;
        margin-bottom: 5px;
      }
      
      .table-controls {
        flex-direction: column;
        align-items: stretch;
        gap: 10px;
        margin-bottom: 15px;
      }
      
      .search-box {
        min-width: 100%;
      }
      
      .search-input {
        padding: 11px 15px 11px 40px;
        font-size: 14px;
        border-radius: 8px;
        border-width: 1.5px;
      }
      
      .search-input:focus {
        box-shadow: 0 0 0 2px rgba(212, 167, 98, 0.2);
      }
      
      .search-icon {
        left: 12px;
        font-size: 16px;
      }
      
      .stats-summary {
        font-size: 13px;
        padding: 8px 12px;
        text-align: center;
        white-space: normal;
      }
      
      .filter-buttons {
        justify-content: center;
        gap: 6px;
        margin-bottom: 15px;
      }
      
      .filter-btn {
        padding: 6px 10px;
        font-size: 11px;
        flex: 1;
        min-width: 70px;
        justify-content: center;
        border-radius: 16px;
      }
      
      /* Show mobile card view, hide table */
      .cinema-table-container {
        display: none;
      }
      
      .mobile-cinema-list {
        display: block;
      }
      
      .cinema-card {
        padding: 15px;
        margin-bottom: 12px;
        border-radius: 10px;
      }
      
      .cinema-card-header {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 10px;
      }
      
      .cinema-card-image {
        width: 100%;
        max-width: 150px;
        height: 100px;
      }
      
      .cinema-card-content {
        width: 100%;
        text-align: center;
      }
      
      .cinema-card-title {
        font-size: 16px;
      }
      
      .cinema-card-meta {
        justify-content: center;
        font-size: 11px;
      }
      
      .cinema-card-preview {
        font-size: 13px;
        padding: 10px;
        margin-bottom: 12px;
        max-height: 60px;
        line-height: 1.4;
      }
      
      .cinema-card-footer {
        flex-direction: column;
        gap: 12px;
        padding-top: 12px;
      }
      
      .cinema-card-category {
        width: 100%;
        justify-content: center;
        font-size: 12px;
      }
      
      .cinema-card-actions {
        width: 100%;
        flex-direction: column;
        gap: 8px;
      }
      
      .action-btn {
        width: 100%;
        padding: 11px;
        font-size: 14px;
        min-height: 44px;
        justify-content: center;
      }
      
      .empty-state {
        padding: 40px 15px;
      }
      
      .empty-icon {
        font-size: 48px;
      }
      
      .empty-state h3 {
        font-size: 18px;
      }
      
      .empty-state p {
        font-size: 14px;
      }
    }
    
    /* Very small devices (phones, 360px and down) */
    @media (max-width: 360px) {
      .header {
        padding: 15px 12px;
      }
      
      .header h1 {
        font-size: 18px;
      }
      
      .nav-links {
        grid-template-columns: 1fr;
      }
      
      .nav-links a {
        width: 100%;
      }
      
      .content-card {
        padding: 15px;
      }
      
      .content-card h2 {
        font-size: 17px;
      }
      
      .search-input {
        padding: 10px 12px 10px 38px;
      }
      
      .filter-buttons {
        grid-template-columns: repeat(3, 1fr);
      }
      
      .filter-btn {
        min-width: 60px;
        font-size: 10px;
        padding: 5px 8px;
      }
      
      .cinema-card {
        padding: 12px;
      }
      
      .cinema-card-title {
        font-size: 15px;
      }
      
      .cinema-card-image {
        height: 80px;
      }
      
      .action-btn {
        padding: 10px;
        font-size: 13px;
      }
    }
    
    /* Orientation specific adjustments */
    @media (max-height: 500px) and (orientation: landscape) {
      .header {
        padding: 15px;
      }
      
      .navigation {
        padding: 12px;
      }
      
      .content-card {
        padding: 20px;
      }
      
      .mobile-cinema-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }
      
      .cinema-card {
        margin-bottom: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
      }
      
      .cinema-card-preview {
        flex: 1;
        max-height: 50px;
      }
      
      .cinema-card-footer {
        margin-top: auto;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .search-input,
      .action-btn,
      .btn,
      .nav-links a,
      .filter-btn,
      .cinema-label {
        border-width: 0.5px;
      }
    }
    
    /* Print styles */
    @media print {
      body {
        background: white;
        padding: 0;
      }
      
      .header,
      .navigation,
      .table-controls,
      .filter-buttons,
      .action-buttons {
        display: none;
      }
      
      .content-card {
        box-shadow: none;
        padding: 0;
      }
      
      .cinema-table-container {
        border: none;
      }
      
      .cinema-table {
        min-width: auto;
      }
      
      .cinema-table th {
        background: #f0f0f0;
        color: #000;
      }
    }
    
    /* Accessibility improvements */
    @media (prefers-reduced-motion: reduce) {
      *,
      *::before,
      *::after {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
      }
    }
    
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
  </style>
</head>
<body>

<div class="dashboard-container">
  
  <!-- Header -->
  <div class="header">
    <h1>Manage Cinema Content</h1>
    <div class="stats-badge">
      <span>📊</span>
      <span>
        <?php 
        $totalCinema = $result ? $result->num_rows : 0;
        echo $totalCinema . " item" . ($totalCinema != 1 ? 's' : '');
        ?>
      </span>
    </div>
  </div>
  
  <!-- Navigation -->
  <div class="navigation">
    <div class="nav-links">
      <a href="/thinnai-palli/admin/dashboard.php">Dashboard</a>
      <a href="/thinnai-palli/">Home</a>
      <a href="add.php">Add New Cinema</a>
    </div>
    <div class="page-actions">
      <a href="add.php" class="btn btn-primary">
        <span>+</span> Add New Cinema
      </a>
    </div>
  </div>
  
  <!-- Main Content Card -->
  <div class="content-card">
    <h2>Cinema Content List</h2>
    
    <!-- Table Controls -->
    <div class="table-controls">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" 
               id="searchInput" 
               class="search-input" 
               placeholder="Search cinema content by title...">
      </div>
      <div class="stats-summary" id="statsSummary">
        Showing <?php echo $totalCinema; ?> items
      </div>
    </div>
    
    <!-- Filter Buttons -->
    <div class="filter-buttons">
      <button class="filter-btn active" data-filter="all">🎬 All</button>
      <button class="filter-btn" data-filter="actor">🎭 Actor</button>
      <button class="filter-btn" data-filter="movie">🎥 Movie</button>
      <button class="filter-btn" data-filter="song">🎵 Song</button>
      <button class="filter-btn" data-filter="memory">💭 Memory</button>
    </div>
    
    <!-- Cinema Table (Desktop) -->
    <div class="cinema-table-container">
      <?php if ($result && $result->num_rows > 0) { ?>
      <table class="cinema-table" id="cinemaTable">
        <thead>
          <tr>
            <th>Image</th>
            <th>Title & Details</th>
            <th>Category</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { 
            $createdDate = date("M j, Y", strtotime($row['created_at']));
            $contentPreview = htmlspecialchars(substr($row['content'], 0, 80) . (strlen($row['content']) > 80 ? '...' : ''));
          ?>
          <tr class="cinema-row" 
              data-title="<?php echo htmlspecialchars(strtolower($row['title'])); ?>"
              data-label="<?php echo htmlspecialchars($row['label']); ?>">
            <td>
              <?php if (!empty($row['image_path'])) { ?>
              <img src="/<?php echo htmlspecialchars($row['image_path']); ?>" 
                   alt="<?php echo htmlspecialchars($row['title']); ?>" 
                   class="cinema-image"
                   loading="lazy">
              <?php } else { ?>
              <div style="width:100px;height:70px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#999;">
                No Image
              </div>
              <?php } ?>
            </td>
            <td>
              <div class="cinema-title"><?php echo htmlspecialchars($row['title']); ?></div>
              <div style="font-size:13px;color:#666;margin-top:5px;"><?php echo $contentPreview; ?></div>
              <div class="cinema-meta">
                <span title="Created Date">📅 <?php echo $createdDate; ?></span>
                <span title="Content Length">📝 <?php echo strlen($row['content']); ?> chars</span>
              </div>
            </td>
            <td>
              <span class="cinema-label label-<?php echo htmlspecialchars($row['label']); ?>">
                <?php 
                $labelIcons = [
                  'actor' => '🎭',
                  'movie' => '🎥',
                  'song' => '🎵',
                  'memory' => '💭'
                ];
                echo ($labelIcons[$row['label']] ?? '📌') . ' ' . ucfirst($row['label']);
                ?>
              </span>
            </td>
            <td>
              <div class="action-buttons">
                <a href="edit.php?id=<?php echo $row['id']; ?>" 
                   class="action-btn action-btn-edit">
                  <span>✏️</span> Edit
                </a>
                <a href="delete.php?id=<?php echo $row['id']; ?>"
                   class="action-btn action-btn-delete"
                   onclick="return confirmDelete(<?php echo $row['id']; ?>, '<?php echo addslashes($row['title']); ?>')">
                  <span>🗑️</span> Delete
                </a>
              </div>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <?php } else { ?>
      <!-- Empty State -->
      <div class="empty-state">
        <div class="empty-icon">🎬</div>
        <h3>No Cinema Content Found</h3>
        <p>You haven't added any cinema content yet. Start by preserving classic Tamil cinema memories.</p>
        <a href="add.php" class="btn btn-primary" style="font-size:16px;padding:12px 30px;">
          <span>+</span> Add First Cinema Content
        </a>
      </div>
      <?php } ?>
    </div>
    
    <!-- Mobile Cinema List -->
    <div class="mobile-cinema-list" id="mobileCinemaList">
      <?php 
      // Reset result pointer for mobile view
      if ($result && $result->num_rows > 0) {
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) { 
          $createdDate = date("M j, Y", strtotime($row['created_at']));
          $contentPreview = htmlspecialchars(substr($row['content'], 0, 100) . (strlen($row['content']) > 100 ? '...' : ''));
          $labelIcons = [
            'actor' => '🎭',
            'movie' => '🎥',
            'song' => '🎵',
            'memory' => '💭'
          ];
          $labelIcon = $labelIcons[$row['label']] ?? '📌';
        ?>
        <div class="cinema-card mobile-cinema-card" 
             data-title="<?php echo htmlspecialchars(strtolower($row['title'])); ?>"
             data-label="<?php echo htmlspecialchars($row['label']); ?>">
          <div class="cinema-card-header">
            <?php if (!empty($row['image_path'])) { ?>
            <img src="/<?php echo htmlspecialchars($row['image_path']); ?>" 
                 alt="<?php echo htmlspecialchars($row['title']); ?>" 
                 class="cinema-card-image"
                 loading="lazy">
            <?php } else { ?>
            <div style="width:80px;height:60px;background:#f0f0f0;border-radius:8px;display:flex;align-items:center;justify-content:center;color:#999;font-size:12px;">
              No Image
            </div>
            <?php } ?>
            <div class="cinema-card-content">
              <div class="cinema-card-title"><?php echo htmlspecialchars($row['title']); ?></div>
              <div class="cinema-card-meta">
                <span title="Created Date">📅 <?php echo $createdDate; ?></span>
                <span title="Content Length">📝 <?php echo strlen($row['content']); ?> chars</span>
              </div>
            </div>
          </div>
          <div class="cinema-card-preview" title="<?php echo htmlspecialchars($row['content']); ?>">
            <?php echo nl2br($contentPreview); ?>
          </div>
          <div class="cinema-card-footer">
            <div class="cinema-card-category label-<?php echo htmlspecialchars($row['label']); ?>">
              <span><?php echo $labelIcon; ?></span>
              <span><?php echo ucfirst($row['label']); ?></span>
            </div>
            <div class="cinema-card-actions">
              <a href="edit.php?id=<?php echo $row['id']; ?>" 
                 class="action-btn action-btn-edit">
                <span>✏️</span> Edit
              </a>
              <a href="delete.php?id=<?php echo $row['id']; ?>"
                 class="action-btn action-btn-delete"
                 onclick="return confirmDelete(<?php echo $row['id']; ?>, '<?php echo addslashes($row['title']); ?>')">
                <span>🗑️</span> Delete
              </a>
            </div>
          </div>
        </div>
        <?php }
      } else { ?>
      <!-- Mobile Empty State -->
      <div class="empty-state">
        <div class="empty-icon">🎬</div>
        <h3>No Cinema Content Found</h3>
        <p>Start by preserving classic Tamil cinema memories.</p>
        <a href="add.php" class="btn btn-primary" style="font-size:16px;padding:12px 30px;width:100%;">
          <span>+</span> Add First Content
        </a>
      </div>
      <?php } ?>
    </div>
    
    <!-- Original table (hidden but preserved) -->
    <table border="1" cellpadding="10" cellspacing="0" style="display:none;">
      <tr>
        <th>Image</th>
        <th>Title</th>
        <th>Label</th>
        <th>Action</th>
      </tr>
      <?php 
      // Reset result pointer for original table
      if ($result && $result->num_rows > 0) {
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td>
            <img src="/<?php echo $row['image_path']; ?>" width="80">
          </td>
          <td><?php echo htmlspecialchars($row['title']); ?></td>
          <td><?php echo htmlspecialchars($row['label']); ?></td>
          <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
            |
            <a href="delete.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Delete this content?');"
               style="color:red;">
              Delete
            </a>
          </td>
        </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="4" align="center">No cinema content found</td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var desktopRows = document.querySelectorAll('.cinema-row');
    var mobileCards = document.querySelectorAll('.mobile-cinema-card');
    var statsSummary = document.getElementById('statsSummary');
    var filterButtons = document.querySelectorAll('.filter-btn');
    var totalCinema = <?php echo $totalCinema; ?>;
    var isMobile = window.innerWidth <= 767;
    
    function applyFilters() {
      var searchTerm = searchInput ? searchInput.value.toLowerCase().trim() : '';
      var activeFilter = document.querySelector('.filter-btn.active').getAttribute('data-filter');
      var visibleCount = 0;
      
      // Filter desktop rows
      for (var i = 0; i < desktopRows.length; i++) {
        var row = desktopRows[i];
        var title = row.getAttribute('data-title');
        var label = row.getAttribute('data-label');
        
        var matchesSearch = searchTerm === '' || 
                           (title && title.indexOf(searchTerm) !== -1);
        
        var matchesFilter = activeFilter === 'all' || label === activeFilter;
        
        if (matchesSearch && matchesFilter) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      }
      
      // Filter mobile cards
      for (var j = 0; j < mobileCards.length; j++) {
        var card = mobileCards[j];
        var title = card.getAttribute('data-title');
        var label = card.getAttribute('data-label');
        
        var matchesSearch = searchTerm === '' || 
                           (title && title.indexOf(searchTerm) !== -1);
        
        var matchesFilter = activeFilter === 'all' || label === activeFilter;
        
        if (matchesSearch && matchesFilter) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      }
      
      // Update stats summary
      var visibleItemCount = searchTerm === '' && activeFilter === 'all' ? totalCinema : Math.ceil(visibleCount / 2);
      var filterText = activeFilter !== 'all' ? ' (' + activeFilter + ')' : '';
      var searchText = searchTerm ? ' (filtered)' : '';
      statsSummary.textContent = 'Showing ' + visibleItemCount + ' of ' + totalCinema + ' items' + filterText + searchText;
      
      // Show/hide no results message
      var desktopTbody = document.querySelector('.cinema-table tbody');
      var mobileList = document.getElementById('mobileCinemaList');
      var noResultsDesktop = document.getElementById('noResultsDesktop');
      var noResultsMobile = document.getElementById('noResultsMobile');
      
      if (visibleItemCount === 0) {
        // Desktop no results
        if (!noResultsDesktop && desktopTbody) {
          noResultsDesktop = document.createElement('tr');
          noResultsDesktop.id = 'noResultsDesktop';
          noResultsDesktop.innerHTML = '<td colspan="4" style="text-align:center;padding:40px;">' +
                                      '<div style="font-size:48px;margin-bottom:15px;">🎬</div>' +
                                      '<h3 style="color:#4b2e1e;margin-bottom:10px;">No matching content</h3>' +
                                      '<p style="color:#666;">Try adjusting your search or filter</p>' +
                                      '</td>';
          desktopTbody.appendChild(noResultsDesktop);
        }
        
        // Mobile no results
        if (!noResultsMobile && mobileList) {
          noResultsMobile = document.createElement('div');
          noResultsMobile.id = 'noResultsMobile';
          noResultsMobile.className = 'empty-state';
          noResultsMobile.innerHTML = '<div class="empty-icon">🎬</div>' +
                                      '<h3>No matching content</h3>' +
                                      '<p>Try adjusting your search or filter</p>';
          mobileList.appendChild(noResultsMobile);
        }
      } else {
        if (noResultsDesktop) {
          noResultsDesktop.parentNode.removeChild(noResultsDesktop);
        }
        if (noResultsMobile) {
          noResultsMobile.parentNode.removeChild(noResultsMobile);
        }
      }
    }
    
    // Search functionality
    if (searchInput) {
      searchInput.addEventListener('input', function() {
        applyFilters();
      });
      
      // Clear search on escape
      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          this.value = '';
          applyFilters();
        }
      });
    }
    
    // Filter functionality
    filterButtons.forEach(function(button) {
      button.addEventListener('click', function() {
        // Update active state
        filterButtons.forEach(function(btn) {
          btn.classList.remove('active');
        });
        this.classList.add('active');
        
        applyFilters();
      });
    });
    
    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
      // Ctrl+F to focus search
      if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        if (searchInput) {
          searchInput.focus();
          searchInput.select();
        }
      }
    });
    
    // Responsive behavior on resize
    window.addEventListener('resize', function() {
      isMobile = window.innerWidth <= 767;
    });
    
    // Touch improvements for mobile
    if ('ontouchstart' in window) {
      // Add touch feedback
      var touchElements = document.querySelectorAll('.action-btn, .btn, .nav-links a, .filter-btn');
      touchElements.forEach(function(el) {
        el.addEventListener('touchstart', function() {
          this.style.transform = 'scale(0.98)';
          this.style.opacity = '0.9';
        });
        
        el.addEventListener('touchend', function() {
          this.style.transform = '';
          this.style.opacity = '';
        });
        
        // Prevent sticky hover on touch devices
        el.addEventListener('touchstart', function() {
          this.classList.remove('hover');
        });
      });
    }
    
    // Initialize filters for any existing search term
    if (searchInput && searchInput.value) {
      applyFilters();
    }
  });
  
  // Enhanced delete confirmation
  function confirmDelete(id, title) {
    // Check if mobile
    var isMobile = window.innerWidth <= 767;
    
    // Create modal
    var modal = document.createElement('div');
    modal.style.cssText = 'position: fixed;' +
                         'top: 0;' +
                         'left: 0;' +
                         'right: 0;' +
                         'bottom: 0;' +
                         'background: rgba(0,0,0,0.7);' +
                         'display: flex;' +
                         'align-items: center;' +
                         'justify-content: center;' +
                         'z-index: 1000;' +
                         'padding: 20px;';
    
    modal.innerHTML = '<div style="background:white;border-radius:15px;padding:' + (isMobile ? '20px' : '30px') + ';max-width:400px;width:100%;">' +
                      '<div style="font-size:' + (isMobile ? '36px' : '48px') + ';text-align:center;margin-bottom:20px;">⚠️</div>' +
                      '<h3 style="color:#dc3545;text-align:center;margin-bottom:15px;font-size:' + (isMobile ? '18px' : '20px') + ';">Confirm Delete</h3>' +
                      '<p style="text-align:center;color:#666;margin-bottom:25px;line-height:1.6;font-size:' + (isMobile ? '14px' : '16px') + ';">' +
                      'Are you sure you want to delete the cinema content:<br>' +
                      '<strong style="color:#4b2e1e;display:block;margin:10px 0;padding:10px;background:#f8f4ef;border-radius:6px;font-size:' + (isMobile ? '14px' : '16px') + ';">"' + title + '"</strong><br>' +
                      'This action cannot be undone.' +
                      '</p>' +
                      '<div style="display:flex;gap:15px;justify-content:center;flex-direction:' + (isMobile ? 'column' : 'row') + ';">' +
                      '<button id="cancelBtn" ' +
                      'style="padding:' + (isMobile ? '14px' : '12px 25px') + ';background:#f8f9fa;border:1px solid #ddd;border-radius:8px;color:#666;font-weight:600;cursor:pointer;flex:1;font-size:' + (isMobile ? '16px' : '14px') + ';min-height:' + (isMobile ? '48px' : 'auto') + ';">' +
                      'Cancel' +
                      '</button>' +
                      '<button id="deleteBtn"' +
                      'style="padding:' + (isMobile ? '14px' : '12px 25px') + ';background:#dc3545;border:none;border-radius:8px;color:white;font-weight:600;cursor:pointer;flex:1;font-size:' + (isMobile ? '16px' : '14px') + ';min-height:' + (isMobile ? '48px' : 'auto') + ';">' +
                      'Delete Content' +
                      '</button>' +
                      '</div>' +
                      '</div>';
    
    document.body.appendChild(modal);
    
    // Prevent scrolling when modal is open
    document.body.style.overflow = 'hidden';
    
    // Add event listeners
    document.getElementById('cancelBtn').onclick = function() {
      document.body.removeChild(modal);
      document.body.style.overflow = '';
    };
    
    document.getElementById('deleteBtn').onclick = function() {
      window.location.href = 'delete.php?id=' + id;
    };
    
    // Close on background click
    modal.onclick = function(e) {
      if (e.target === modal) {
        document.body.removeChild(modal);
        document.body.style.overflow = '';
      }
    };
    
    // Close on escape key
    modal.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        document.body.removeChild(modal);
        document.body.style.overflow = '';
      }
    });
    
    // Focus on cancel button initially
    document.getElementById('cancelBtn').focus();
    
    return false;
  }
</script>

</body>
</html>