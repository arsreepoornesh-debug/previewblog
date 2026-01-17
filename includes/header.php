<?php
// ✅ SESSION START MUST BE AT THE VERY TOP
// ✅ No spaces, no empty lines, no HTML before this
session_start();
?>
<!DOCTYPE html>
<html lang="ta">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>திண்ணைப் பள்ளி - Thinnai Palli</title>
    
    <!-- Tamil Font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+Tamil:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- External CSS -->
    <link rel="stylesheet" href="/thinnai-palli/assets/css/style.css">
    
    <!-- Inline CSS (Properly Closed) -->
    <style>
        /* BASE STYLES */
        body {
            font-family: "Noto Serif Tamil", serif;
            font-size: 18px;
            line-height: 1.6;
            color: #3b2b1c;
            background-color: #f6efe3;
            margin: 0;
            padding: 0;
        }
        
        /* CONTAINER */
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* HEADER STYLES - ONLY BACKGROUND COLOR CHANGED */
        .site-header {
            background: #4E5D44; /* Dark muted olive/heritage green */
            border-bottom: 2px solid #5a3a1b;
            padding: 15px 0;
        }
        
        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        /* LOGO */
        .site-logo img {
            height: 65px;
            width: auto;
        }
        
        /* TITLE */
        .site-title {
            text-align: center;
            flex-grow: 1;
        }
        
        .site-title h1 {
            color: #5a3a1b;
            font-size: 2.2rem;
            margin: 0;
        }
        
        /* AUTHOR */
        .site-author img {
            height: 55px;
            width: 55px;
            border-radius: 50%;
            border: 2px solid #5a3a1b;
            object-fit: cover;
        }
        
        /* NAVIGATION - UNCHANGED */
        .navbar {
            background: #5a3a1b;
            padding: 0 30px;
        }
        
        .navbar ul {
            list-style: none;
            display: flex;
            align-items: center;
            margin: 0;
            padding: 0;
        }
        
        .navbar li {
            margin-right: 25px;
        }
        
        .navbar a {
            color: white;
            text-decoration: none;
            font-size: 15px;
            padding: 14px 0;
            display: inline-block;
        }
        
        .navbar a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    
    <!-- Header Section -->
    <header class="site-header">
        <div class="container header-container">
            <!-- Logo -->
            <div class="site-logo">
                <img src="/thinnai-palli/assets/images/logo.png" alt="திண்ணைப் பள்ளி">
            </div>
            
            <!-- Title -->
            <div class="site-title">
                <h1>திண்ணைப் பள்ளி</h1>
            </div>
            
            <!-- Author -->
            <div class="site-author">
                <img src="/thinnai-palli/assets/images/author.png" alt="Author">
            </div>
        </div>
    </header>