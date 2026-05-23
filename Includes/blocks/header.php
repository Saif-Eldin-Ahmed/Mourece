<?php
$currentPage = basename(dirname($_SERVER['PHP_SELF']));
$activeClass = "text-[#E5D1C0] border-b-2 border-[#E5D1C0] pb-1 transition-all duration-500";
$inactiveClass = "text-[#E5D1C0]/70 hover:text-[#E5D1C0] transition-all duration-500";

// Page specific titles
$titles = [
  'Homepage' => 'Mourece | A Step into Heritage',
  'Menu' => 'Menu | Mourece',
  'Reservation' => 'Reservations | Mourece',
  'Contact' => 'Mourece | Connect with the Atelier'
];
$title = isset($titles[$currentPage]) ? $titles[$currentPage] : 'Mourece';

// Page specific body classes
$bodyClasses = [
  'Homepage' => 'bg-surface text-on-surface font-body selection:bg-secondary-container selection:text-primary',
  'Menu' => 'bg-surface text-primary selection:bg-secondary-container selection:text-primary',
  'Reservation' => 'bg-surface font-body text-primary selection:bg-secondary-container selection:text-primary',
  'Contact' => 'bg-surface text-primary selection:bg-secondary-container selection:text-primary'
];
$bodyClass = isset($bodyClasses[$currentPage]) ? $bodyClasses[$currentPage] : 'bg-surface text-primary selection:bg-secondary-container selection:text-primary';
?>
<!DOCTYPE html>
<html class="light" lang="en">

<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title><?php echo $title; ?></title>
  <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&amp;family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style.css" />
</head>

<body class="<?php echo $bodyClass; ?>">
  <header class="fixed top-0 w-full z-50 bg-transparent transition-colors duration-500 h-30 flex" id="site-header">
    <nav class="flex justify-between items-center w-full px-8 md:px-12 py-4 max-w-screen-2xl mx-auto transition-all duration-500" id="main-nav">
      <div class="flex items-center gap-12" id="nav-left-side">
        <a href="../Homepage/index.php" class="transition-all duration-700 transform w-32 md:w-40 " id="logo-container">
          <img src="../Includes/images/Logo.png" alt="Mourece Logo" class="h-16 md:h-20 object-contain transition-all duration-700" id="header-logo" />
        </a>
        <ul
          class="hidden md:flex gap-8 font-serif tracking-tight text-base uppercase items-center transition-all duration-700"
          id="nav-links">
          <li><a class="<?php echo ($currentPage == 'Homepage') ? $activeClass : $inactiveClass; ?>" href="../Homepage/index.php">HOME</a></li>
          <li><a class="<?php echo ($currentPage == 'Menu') ? $activeClass : $inactiveClass; ?>" href="../Menu/index.php">MENU</a></li>
          <li><a class="<?php echo ($currentPage == 'Reservation') ? $activeClass : $inactiveClass; ?>" href="../Reservation/index.php">RESERVATION</a></li>
          <li><a class="<?php echo ($currentPage == 'Contact') ? $activeClass : $inactiveClass; ?>" href="../Contact/index.php">CONTACT</a></li>
        </ul>
      </div>

      <div class="flex items-center justify-end gap-6">
        <a href="../Reservation/index.php" class="hidden md:block bg-[#E5D1C0] text-[#3D261C] px-6 py-2.5 font-label text-xs uppercase tracking-widest hover:bg-[#F2E5D5] transition-all duration-300">
          Book a Table
        </a>
        <!-- Mobile Trigger -->
        <button class="md:hidden flex flex-col gap-1.5 p-4 -mr-4 relative z-[1001]" id="mobile-menu-trigger">
          <span class="w-8 h-[2px] bg-[#E5D1C0]"></span>
          <span class="w-8 h-[2px] bg-[#E5D1C0]"></span>
          <span class="w-5 h-[2px] bg-[#E5D1C0] self-end"></span>
        </button>
      </div>
    </nav>


  </header>

  <!-- Mobile Menu Overlay -->
  <div id="mobile-menu" class="fixed inset-0 z-[1000] bg-[#F2E5D5] translate-x-full transition-transform duration-500 ease-in-out pattern-overlay flex flex-col items-center justify-between py-20 px-12">
    <div class="w-full flex flex-col items-center gap-12">
      <span class="text-[10px] uppercase tracking-[0.4em] text-primary/40 font-label">EST. 1924</span>
      <button class="absolute top-12 right-12 text-primary/60 hover:text-primary transition-colors p-2" id="close-mobile-menu">
        <span class="material-symbols-outlined text-4xl">close</span>
      </button>

      <ul class="flex flex-col items-center gap-10 text-center">
        <li>
          <a href="../Homepage/index.php" class="font-headline text-3xl text-primary italic hover:opacity-70 transition-opacity">HOME</a>
          <?php if ($currentPage == 'Homepage'): ?>
            <div class="w-16 h-px bg-primary/20 mx-auto mt-4"></div>
          <?php endif; ?>
        </li>
        <li>
          <a href="../Menu/index.php" class="font-headline text-3xl text-primary italic hover:opacity-70 transition-opacity">THE MENU</a>
          <?php if ($currentPage == 'Menu'): ?>
            <div class="w-16 h-px bg-primary/20 mx-auto mt-4"></div>
          <?php endif; ?>
        </li>
        <li>
          <a href="../Reservation/index.php" class="font-headline text-3xl text-primary italic hover:opacity-70 transition-opacity">RESERVATIONS</a>
          <?php if ($currentPage == 'Reservation'): ?>
            <div class="w-16 h-px bg-primary/20 mx-auto mt-4"></div>
          <?php endif; ?>
        </li>
        <li>
          <a href="../Contact/index.php" class="font-headline text-3xl text-primary italic hover:opacity-70 transition-opacity">CONTACT</a>
          <?php if ($currentPage == 'Contact'): ?>
            <div class="w-16 h-px bg-primary/20 mx-auto mt-4"></div>
          <?php endif; ?>
        </li>
      </ul>
    </div>

    <div class="flex items-center justify-center opacity-30">
      <span class="material-symbols-outlined text-5xl text-primary">restaurant</span>
    </div>
  </div>