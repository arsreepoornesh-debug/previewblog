<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: ../login.php");
  exit;
}

include '../../includes/db.php';

$result = $conn->query(
  "SELECT id, title, summary, created_at 
   FROM tamil_word_pages 
   ORDER BY created_at DESC"
);
?>
<!DOCTYPE html>
<html lang="ta">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Tamil Word Pages - Admin</title>
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
      content: "📘";
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
    
    /* Success messages */
    .message {
      padding: 15px 20px;
      border-radius: 10px;
      margin-bottom: 25px;
      font-weight: 600;
      display: flex;
      align-items: center;
      animation: fadeIn 0.5s ease-out;
    }
    
    .message.success {
      background: rgba(40, 167, 69, 0.1);
      color: #28a745;
      border-left: 4px solid #28a745;
    }
    
    .message:before {
      margin-right: 10px;
      font-size: 20px;
    }
    
    /* Enhanced table styling */
    .pages-table-container {
      overflow-x: auto;
      border-radius: 10px;
      border: 1px solid rgba(75, 46, 30, 0.15);
      -webkit-overflow-scrolling: touch; /* Smooth scrolling on iOS */
    }
    
    .pages-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 800px;
    }
    
    .pages-table thead {
      background: linear-gradient(135deg, #4b2e1e 0%, #2c1810 100%);
    }
    
    .pages-table th {
      color: white;
      font-weight: 600;
      text-align: left;
      padding: 18px 20px;
      font-size: 15px;
      border: none;
      position: relative;
      white-space: nowrap;
    }
    
    .pages-table th:after {
      content: '';
      position: absolute;
      right: 0;
      top: 20%;
      height: 60%;
      width: 1px;
      background: rgba(255, 255, 255, 0.3);
    }
    
    .pages-table th:last-child:after {
      display: none;
    }
    
    .pages-table tbody tr {
      background: white;
      transition: all 0.3s ease;
      border-bottom: 1px solid rgba(75, 46, 30, 0.15);
    }
    
    .pages-table tbody tr:nth-child(even) {
      background: #f8f4ef;
    }
    
    .pages-table tbody tr:hover {
      background: rgba(212, 167, 98, 0.1);
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(75, 46, 30, 0.1);
      z-index: 1;
      position: relative;
    }
    
    .pages-table td {
      padding: 20px;
      color: #444;
      border: none;
      vertical-align: top;
    }
    
    /* Title cell styling */
    .page-title {
      font-weight: 600;
      color: #4b2e1e;
      margin-bottom: 5px;
      line-height: 1.4;
      font-size: 16px;
    }
    
    .page-title:hover {
      color: #0066cc;
    }
    
    /* Summary cell styling */
    .page-summary {
      font-size: 14px;
      color: #666;
      line-height: 1.5;
      max-height: 60px;
      overflow: hidden;
      position: relative;
    }
    
    .page-summary:after {
      content: '';
      position: absolute;
      bottom: 0;
      right: 0;
      width: 30%;
      height: 20px;
      background: linear-gradient(to right, transparent, white);
    }
    
    /* Date cell styling */
    .page-date {
      font-size: 14px;
      color: #666;
      white-space: nowrap;
    }
    
    .date-badge {
      background: rgba(75, 46, 30, 0.05);
      padding: 4px 10px;
      border-radius: 4px;
      font-size: 12px;
      color: #4b2e1e;
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
    
    /* Mobile Card View */
    .mobile-pages-list {
      display: none;
    }
    
    .page-card {
      background: white;
      border-radius: 12px;
      padding: 20px;
      margin-bottom: 15px;
      box-shadow: 0 4px 12px rgba(75, 46, 30, 0.1);
      border: 1px solid rgba(75, 46, 30, 0.1);
    }
    
    .page-card-header {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      margin-bottom: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .page-card-title {
      font-weight: 600;
      color: #4b2e1e;
      font-size: 16px;
      line-height: 1.4;
      flex: 1;
      min-width: 200px;
    }
    
    .page-card-id {
      font-size: 12px;
      color: #888;
      background: rgba(75, 46, 30, 0.05);
      padding: 3px 8px;
      border-radius: 4px;
      white-space: nowrap;
    }
    
    .page-card-summary {
      font-size: 14px;
      color: #666;
      line-height: 1.5;
      margin-bottom: 15px;
      padding: 10px;
      background: #f8f4ef;
      border-radius: 6px;
      max-height: 100px;
      overflow: hidden;
      position: relative;
    }
    
    .page-card-summary:after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 20px;
      background: linear-gradient(to bottom, transparent, #f8f4ef);
    }
    
    .page-card-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-top: 1px solid rgba(75, 46, 30, 0.1);
      padding-top: 15px;
      flex-wrap: wrap;
      gap: 10px;
    }
    
    .page-card-date {
      font-size: 13px;
      color: #666;
      display: flex;
      align-items: center;
      gap: 8px;
    }
    
    .page-card-actions {
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
      
      .pages-table th,
      .pages-table td {
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
      
      .message {
        padding: 14px 18px;
        font-size: 15px;
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
      }
      
      .action-buttons {
        flex-direction: column;
        gap: 8px;
      }
      
      .action-btn {
        width: 100%;
        justify-content: center;
        padding: 9px 14px;
        font-size: 12px;
      }
      
      .page-summary {
        max-height: 50px;
        font-size: 13px;
      }
      
      .page-date {
        font-size: 13px;
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
      
      .message {
        padding: 12px 16px;
        font-size: 14px;
        margin-bottom: 20px;
        border-radius: 8px;
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
      
      /* Show mobile card view, hide table */
      .pages-table-container {
        display: none;
      }
      
      .mobile-pages-list {
        display: block;
      }
      
      .page-card {
        padding: 18px;
        margin-bottom: 12px;
      }
      
      .page-card-header {
        margin-bottom: 12px;
      }
      
      .page-card-title {
        font-size: 15px;
        min-width: 150px;
      }
      
      .page-card-summary {
        font-size: 13px;
        padding: 8px;
        margin-bottom: 12px;
        max-height: 80px;
      }
      
      .page-card-footer {
        padding-top: 12px;
      }
      
      .page-card-date {
        font-size: 12px;
      }
      
      .page-card-actions {
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
      
      .message {
        padding: 12px 15px;
        font-size: 13px;
        margin-bottom: 20px;
        border-radius: 8px;
        border-left-width: 3px;
      }
      
      .message:before {
        font-size: 18px;
        margin-right: 8px;
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
      
      /* Show mobile card view, hide table */
      .pages-table-container {
        display: none;
      }
      
      .mobile-pages-list {
        display: block;
      }
      
      .page-card {
        padding: 15px;
        margin-bottom: 12px;
        border-radius: 10px;
      }
      
      .page-card-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 8px;
      }
      
      .page-card-title {
        font-size: 16px;
        min-width: 100%;
        text-align: center;
      }
      
      .page-card-id {
        align-self: center;
      }
      
      .page-card-summary {
        font-size: 13px;
        padding: 10px;
        margin-bottom: 12px;
        max-height: 70px;
        line-height: 1.4;
      }
      
      .page-card-footer {
        flex-direction: column;
        gap: 12px;
        padding-top: 12px;
      }
      
      .page-card-date {
        width: 100%;
        justify-content: center;
        font-size: 12px;
      }
      
      .page-card-actions {
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
      
      .page-card {
        padding: 12px;
      }
      
      .page-card-title {
        font-size: 15px;
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
      
      .mobile-pages-list {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 10px;
      }
      
      .page-card {
        margin-bottom: 0;
        height: 100%;
        display: flex;
        flex-direction: column;
      }
      
      .page-card-summary {
        flex: 1;
        max-height: 60px;
      }
    }
    
    /* High-resolution displays */
    @media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
      .search-input,
      .action-btn,
      .btn,
      .nav-links a {
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
      .action-buttons {
        display: none;
      }
      
      .content-card {
        box-shadow: none;
        padding: 0;
      }
      
      .pages-table-container {
        border: none;
      }
      
      .pages-table {
        min-width: auto;
      }
      
      .pages-table th {
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
    <h1>Manage Tamil Word Pages</h1>
    <div class="stats-badge">
      <span>📊</span>
      <span>
        <?php 
        $totalPages = $result ? $result->num_rows : 0;
        echo $totalPages . " page" . ($totalPages != 1 ? 's' : '');
        ?>
      </span>
    </div>
  </div>
  
  <!-- Navigation -->
  <div class="navigation">
    <div class="nav-links">
      <a href="/thinnai-palli/admin/dashboard.php">Dashboard</a>
      <a href="/thinnai-palli/">Home</a>
      <a href="add.php">Add Tamil Word Page</a>
    </div>
    <div class="page-actions">
      <a href="add.php" class="btn btn-primary">
        <span>+</span> Add New Page
      </a>
    </div>
  </div>
  
  <!-- Main Content Card -->
  <div class="content-card">
    <h2>Tamil Word Pages List</h2>
    
    <!-- Success Messages -->
    <?php if (isset($_GET['deleted'])) { ?>
      <div class="message success">
        ✅ Page deleted successfully
      </div>
    <?php } ?>
    
    <?php if (isset($_GET['updated'])) { ?>
      <div class="message success">
        ✨ Page updated successfully
      </div>
    <?php } ?>
    
    <!-- Table Controls -->
    <div class="table-controls">
      <div class="search-box">
        <span class="search-icon">🔍</span>
        <input type="text" 
               id="searchInput" 
               class="search-input" 
               placeholder="Search pages by title or content...">
      </div>
      <div class="stats-summary" id="statsSummary">
        Showing <?php echo $totalPages; ?> pages
      </div>
    </div>
    
    <!-- Pages Table (Desktop) -->
    <div class="pages-table-container">
      <?php if ($result && $result->num_rows > 0) { ?>
      <table class="pages-table" id="pagesTable">
        <thead>
          <tr>
            <th width="25%">Title</th>
            <th width="40%">Summary</th>
            <th width="15%">Created</th>
            <th width="20%">Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($row = $result->fetch_assoc()) { 
            $createdDate = date("M j, Y", strtotime($row['created_at']));
            $summary = htmlspecialchars(substr($row['summary'], 0, 150) . (strlen($row['summary']) > 150 ? '...' : ''));
          ?>
          <tr class="page-row" 
              data-title="<?php echo htmlspecialchars(strtolower($row['title'])); ?>"
              data-summary="<?php echo htmlspecialchars(strtolower($row['summary'])); ?>">
            <td>
              <div class="page-title"><?php echo htmlspecialchars($row['title']); ?></div>
              <div style="font-size:12px;color:#888;margin-top:5px;">
                ID: <?php echo $row['id']; ?>
              </div>
            </td>
            <td>
              <div class="page-summary" title="<?php echo htmlspecialchars($row['summary']); ?>">
                <?php echo nl2br($summary); ?>
              </div>
            </td>
            <td>
              <div class="page-date">
                <div class="date-badge"><?php echo $createdDate; ?></div>
                <div style="font-size:12px;color:#999;margin-top:5px;">
                  <?php echo date("g:i A", strtotime($row['created_at'])); ?>
                </div>
              </div>
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
        <div class="empty-icon">📘</div>
        <h3>No Tamil Word Pages Found</h3>
        <p>You haven't added any Tamil word pages yet. Start by creating your first page to organize Tamil vocabulary.</p>
        <a href="add.php" class="btn btn-primary" style="font-size:16px;padding:12px 30px;">
          <span>+</span> Create Your First Page
        </a>
      </div>
      <?php } ?>
    </div>
    
    <!-- Mobile Pages List -->
    <div class="mobile-pages-list" id="mobilePagesList">
      <?php 
      // Reset result pointer for mobile view
      if ($result && $result->num_rows > 0) {
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) { 
          $createdDate = date("M j, Y", strtotime($row['created_at']));
          $createdTime = date("g:i A", strtotime($row['created_at']));
          $summary = htmlspecialchars(substr($row['summary'], 0, 120) . (strlen($row['summary']) > 120 ? '...' : ''));
        ?>
        <div class="page-card mobile-page-card" 
             data-title="<?php echo htmlspecialchars(strtolower($row['title'])); ?>"
             data-summary="<?php echo htmlspecialchars(strtolower($row['summary'])); ?>">
          <div class="page-card-header">
            <div class="page-card-title"><?php echo htmlspecialchars($row['title']); ?></div>
            <div class="page-card-id">ID: <?php echo $row['id']; ?></div>
          </div>
          <div class="page-card-summary" title="<?php echo htmlspecialchars($row['summary']); ?>">
            <?php echo nl2br($summary); ?>
          </div>
          <div class="page-card-footer">
            <div class="page-card-date">
              <span>📅</span>
              <span><?php echo $createdDate; ?> • <?php echo $createdTime; ?></span>
            </div>
            <div class="page-card-actions">
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
        <div class="empty-icon">📘</div>
        <h3>No Tamil Word Pages Found</h3>
        <p>Start by creating your first page to organize Tamil vocabulary.</p>
        <a href="add.php" class="btn btn-primary" style="font-size:16px;padding:12px 30px;width:100%;">
          <span>+</span> Create First Page
        </a>
      </div>
      <?php } ?>
    </div>
    
    <!-- Original table (hidden but preserved) -->
    <table style="display:none;">
      <tr>
        <th>Title</th>
        <th>Summary</th>
        <th>Created</th>
        <th>Action</th>
      </tr>
      <?php 
      // Reset result pointer for original table
      if ($result && $result->num_rows > 0) {
        $result->data_seek(0);
        while ($row = $result->fetch_assoc()) { ?>
        <tr>
          <td><?php echo htmlspecialchars($row['title']); ?></td>
          <td><?php echo nl2br(htmlspecialchars($row['summary'])); ?></td>
          <td><?php echo $row['created_at']; ?></td>
          <td>
            <a href="edit.php?id=<?php echo $row['id']; ?>"
               style="color:blue; margin-right:10px;">
               Edit
            </a>
            <a href="delete.php?id=<?php echo $row['id']; ?>"
               onclick="return confirm('Delete this page?');"
               style="color:red;">
               Delete
            </a>
          </td>
        </tr>
        <?php }
      } else { ?>
        <tr>
          <td colspan="4" align="center">No Tamil word pages found</td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('searchInput');
    var desktopRows = document.querySelectorAll('.page-row');
    var mobileCards = document.querySelectorAll('.mobile-page-card');
    var statsSummary = document.getElementById('statsSummary');
    var totalPages = <?php echo $totalPages; ?>;
    var isMobile = window.innerWidth <= 767;
    
    function searchPages(searchTerm) {
      var visibleCount = 0;
      
      // Search in desktop table
      for (var i = 0; i < desktopRows.length; i++) {
        var row = desktopRows[i];
        var title = row.getAttribute('data-title');
        var summary = row.getAttribute('data-summary');
        var matches = searchTerm === '' || 
                     (title && title.indexOf(searchTerm) !== -1) || 
                     (summary && summary.indexOf(searchTerm) !== -1);
        
        if (matches) {
          row.style.display = '';
          visibleCount++;
        } else {
          row.style.display = 'none';
        }
      }
      
      // Search in mobile cards
      for (var j = 0; j < mobileCards.length; j++) {
        var card = mobileCards[j];
        var title = card.getAttribute('data-title');
        var summary = card.getAttribute('data-summary');
        var matches = searchTerm === '' || 
                     (title && title.indexOf(searchTerm) !== -1) || 
                     (summary && summary.indexOf(searchTerm) !== -1);
        
        if (matches) {
          card.style.display = '';
          visibleCount++;
        } else {
          card.style.display = 'none';
        }
      }
      
      // Update stats summary
      var visiblePageCount = searchTerm === '' ? totalPages : Math.ceil(visibleCount / 2);
      statsSummary.textContent = 'Showing ' + visiblePageCount + ' of ' + totalPages + ' pages';
      if (searchTerm) {
        statsSummary.innerHTML = statsSummary.textContent + ' <span style="color:#0066cc;">(filtered)</span>';
      }
      
      // Show/hide no results message
      var desktopTbody = document.querySelector('.pages-table tbody');
      var mobileList = document.getElementById('mobilePagesList');
      var noResultsDesktop = document.getElementById('noResultsDesktop');
      var noResultsMobile = document.getElementById('noResultsMobile');
      
      if (visiblePageCount === 0 && searchTerm) {
        // Desktop no results
        if (!noResultsDesktop && desktopTbody) {
          noResultsDesktop = document.createElement('tr');
          noResultsDesktop.id = 'noResultsDesktop';
          noResultsDesktop.innerHTML = '<td colspan="4" style="text-align:center;padding:40px;">' +
                                      '<div style="font-size:48px;margin-bottom:15px;">🔍</div>' +
                                      '<h3 style="color:#4b2e1e;margin-bottom:10px;">No matching pages</h3>' +
                                      '<p style="color:#666;">Try adjusting your search terms</p>' +
                                      '</td>';
          desktopTbody.appendChild(noResultsDesktop);
        }
        
        // Mobile no results
        if (!noResultsMobile && mobileList) {
          noResultsMobile = document.createElement('div');
          noResultsMobile.id = 'noResultsMobile';
          noResultsMobile.className = 'empty-state';
          noResultsMobile.innerHTML = '<div class="empty-icon">🔍</div>' +
                                      '<h3>No matching pages</h3>' +
                                      '<p>Try adjusting your search terms</p>';
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
        var searchTerm = this.value.toLowerCase().trim();
        searchPages(searchTerm);
      });
      
      // Clear search on escape
      searchInput.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
          this.value = '';
          searchPages('');
        }
      });
    }
    
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
      var touchElements = document.querySelectorAll('.action-btn, .btn, .nav-links a');
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
    
    // Initialize search for any existing search term
    if (searchInput && searchInput.value) {
      searchPages(searchInput.value.toLowerCase().trim());
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
                      'Are you sure you want to delete the Tamil page:<br>' +
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
                      'Delete Page' +
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