<?php
session_start();
require_once 'db.php';

// Hardcoded Credentials
define('ADMIN_USER', 'Admin');
define('ADMIN_PASS', 'Password123!');

// Handle logout
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    unset($_SESSION['admin_logged_in']);
    session_destroy();
    header("Location: index.php");
    exit;
}

// Handle login submission
$loginError = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === ADMIN_USER && $password === ADMIN_PASS) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: index.php");
        exit;
    } else {
        $loginError = 'Invalid credentials. Please try again.';
    }
}

// Check auth state
$isAuthenticated = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// If authenticated, fetch data
$reservations = [];
$contacts = [];
$totalReservations = 0;
$totalContacts = 0;
$totalGuests = 0;

if ($isAuthenticated) {
    try {
        $pdo = getDBConnection();
        
        // Fetch Reservations
        $stmtRes = $pdo->query("SELECT * FROM reservations ORDER BY prefered_date DESC, time DESC");
        $reservations = $stmtRes->fetchAll();
        $totalReservations = count($reservations);
        
        // Calculate total guests
        foreach ($reservations as $res) {
            $totalGuests += (int)($res['guests'] ?? 0);
        }
        
        // Fetch Contacts
        $stmtCont = $pdo->query("SELECT * FROM contacts ORDER BY created_at DESC");
        $contacts = $stmtCont->fetchAll();
        $totalContacts = count($contacts);
        
    } catch (Exception $e) {
        $dbError = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html class="light" lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Mourece | Admin Atelier</title>
    <!-- Tailwind CSS with Forms and Container Queries -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif:ital,wght@0,400;0,700;1,400&amp;family=Manrope:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap" rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        primary: "#3D261C", // Deep Espresso Brown
                        "on-primary": "#F2E5D5", // Light Cream
                        "primary-container": "#523629",
                        "on-primary-container": "#C9B6A3",
                        secondary: "#C9B6A3",
                        "on-secondary": "#3D261C",
                        "secondary-container": "#E5D1C0",
                        "on-secondary-container": "#3D261C",
                        surface: "#F2E5D5", 
                        "surface-dark": "#1F120B",
                        "surface-card": "rgba(61, 38, 28, 0.03)",
                        border: "rgba(61, 38, 28, 0.15)",
                    },
                    fontFamily: {
                        headline: ["Noto Serif"],
                        body: ["Manrope"],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
            background-color: #F2E5D5;
            color: #3D261C;
        }
        .font-serif-headline {
            font-family: 'Noto Serif', serif;
        }
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: rgba(61, 38, 28, 0.05);
        }
        ::-webkit-scrollbar-thumb {
            background: rgba(61, 38, 28, 0.2);
            border-radius: 3px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(61, 38, 28, 0.4);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col justify-between selection:bg-primary selection:text-on-primary">

<?php if (!$isAuthenticated): ?>
    <!-- LOGIN SCREEN -->
    <div class="relative min-h-screen flex items-center justify-center bg-primary overflow-hidden px-4">
        <!-- Background decorative vectors -->
        <div class="absolute inset-0 z-0 opacity-15">
            <div class="absolute top-[-10%] left-[-10%] w-[60%] h-[60%] rounded-full bg-secondary filter blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[60%] h-[60%] rounded-full bg-secondary filter blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-md bg-primary/40 backdrop-blur-xl border border-secondary/20 p-8 md:p-10 shadow-2xl rounded-sm">
            <div class="text-center mb-10">
                <div class="flex justify-center mb-4">
                    <span class="material-symbols-outlined text-secondary text-5xl">lock_open</span>
                </div>
                <h1 class="font-serif-headline text-3xl md:text-4xl text-on-primary italic font-bold">Mourece Atelier</h1>
                <p class="text-secondary/70 text-xs uppercase tracking-[0.3em] mt-2 font-light">Management Dashboard</p>
            </div>

            <?php if (!empty($loginError)): ?>
                <div class="bg-red-950/40 border border-red-800 text-red-200 text-sm px-4 py-3 mb-6 flex items-center space-x-2">
                    <span class="material-symbols-outlined text-sm">error</span>
                    <span><?php echo htmlspecialchars($loginError); ?></span>
                </div>
            <?php endif; ?>

            <form action="index.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-xs uppercase tracking-widest text-secondary/80 mb-2" for="username">Username</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-secondary/60 text-sm">person</span>
                        <input 
                            type="text" 
                            name="username" 
                            id="username" 
                            required 
                            placeholder="Enter Username"
                            class="w-full bg-primary-container/40 border border-secondary/20 rounded-none py-3 pl-10 pr-4 text-on-primary placeholder:text-secondary/40 focus:outline-none focus:border-secondary focus:ring-0 transition-colors"
                        />
                    </div>
                </div>

                <div>
                    <label class="block text-xs uppercase tracking-widest text-secondary/80 mb-2" for="password">Password</label>
                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-secondary/60 text-sm">lock</span>
                        <input 
                            type="password" 
                            name="password" 
                            id="password" 
                            required 
                            placeholder="Enter Password"
                            class="w-full bg-primary-container/40 border border-secondary/20 rounded-none py-3 pl-10 pr-4 text-on-primary placeholder:text-secondary/40 focus:outline-none focus:border-secondary focus:ring-0 transition-colors"
                        />
                    </div>
                </div>

                <div class="pt-2">
                    <button 
                        type="submit" 
                        name="login"
                        class="w-full bg-secondary hover:bg-secondary-container text-primary font-medium py-3.5 uppercase tracking-widest text-xs hover:shadow-lg transition-all duration-300 flex items-center justify-center space-x-2"
                    >
                        <span>Access Dashboard</span>
                        <span class="material-symbols-outlined text-sm">login</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php else: ?>
    <!-- ADMIN DASHBOARD -->
    <div class="min-h-screen flex flex-col md:flex-row bg-[#F2E5D5]">
        
        <!-- Sidebar Navigation -->
        <aside class="w-full md:w-64 bg-primary text-on-primary flex flex-col border-r border-primary/20 shrink-0">
            <div class="p-6 border-b border-primary-container flex items-center justify-between">
                <div>
                    <h2 class="font-serif-headline text-2xl italic font-bold">Mourece</h2>
                    <span class="text-[9px] uppercase tracking-[0.4em] text-secondary">Atelier Admin</span>
                </div>
                <div class="bg-secondary/10 p-1.5 rounded-full md:hidden">
                    <button id="mobile-sidebar-toggle" class="material-symbols-outlined text-secondary">menu</button>
                </div>
            </div>

            <!-- Sidebar links -->
            <nav class="flex-1 px-4 py-6 space-y-2" id="sidebar-nav">
                <button 
                    onclick="switchTab('reservations')"
                    id="btn-reservations"
                    class="tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium bg-secondary text-primary hover:bg-secondary transition-all duration-300"
                >
                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                    <span>Reservations</span>
                </button>
                <button 
                    onclick="switchTab('contacts')"
                    id="btn-contacts"
                    class="tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium text-secondary hover:bg-primary-container transition-all duration-300"
                >
                    <span class="material-symbols-outlined text-lg">mail</span>
                    <span>Contacts</span>
                </button>
            </nav>

            <!-- User footer info -->
            <div class="p-6 border-t border-primary-container bg-primary-container/20 space-y-4">
                <div class="flex items-center space-x-3">
                    <div class="h-9 w-9 bg-secondary text-primary font-bold flex items-center justify-center rounded-none text-sm">
                        AD
                    </div>
                    <div>
                        <p class="text-xs font-bold uppercase tracking-wider">Administrator</p>
                        <p class="text-[10px] text-secondary/60">Session active</p>
                    </div>
                </div>
                <a 
                    href="index.php?action=logout"
                    class="w-full border border-secondary/30 hover:border-secondary text-secondary/80 hover:text-secondary hover:bg-primary-container py-2 text-center text-xs uppercase tracking-widest block transition-all duration-300 flex items-center justify-center space-x-2"
                >
                    <span class="material-symbols-outlined text-sm">logout</span>
                    <span>Log Out</span>
                </a>
            </div>
        </aside>

        <!-- Main Workspace -->
        <main class="flex-1 flex flex-col min-w-0">
            <!-- Top bar -->
            <header class="h-20 bg-surface/30 border-b border-primary/10 px-6 md:px-10 flex items-center justify-between shrink-0">
                <div class="flex items-center space-x-4 flex-1 max-w-xl">
                    <!-- Search Engine Input -->
                    <div class="relative w-full">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary/40 text-lg">search</span>
                        <input 
                            type="text" 
                            id="dashboard-search"
                            oninput="performSearch()"
                            placeholder="Search reservations or contacts (name, email, phone...)"
                            class="w-full bg-primary/5 border border-primary/10 rounded-none py-2.5 pl-10 pr-4 text-primary placeholder:text-primary/40 focus:outline-none focus:border-primary focus:ring-0 transition-colors text-sm"
                        />
                    </div>
                </div>
                <div class="flex items-center space-x-6 pl-4">
                    <div class="hidden lg:block text-right">
                        <p class="text-xs text-primary/60 font-light">Atelier Operations</p>
                        <p class="text-sm font-serif-headline font-bold italic"><?php echo date('F d, Y'); ?></p>
                    </div>
                </div>
            </header>

            <!-- Content Panel -->
            <div class="flex-1 overflow-y-auto p-6 md:p-10 space-y-10">
                
                <!-- Analytics Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Card 1: Reservations -->
                    <div class="bg-surface-variant/20 border border-primary/10 p-6 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-primary/60 font-semibold mb-1">Total Bookings</p>
                            <h3 class="font-serif-headline text-3xl font-bold italic text-primary"><?php echo $totalReservations; ?></h3>
                        </div>
                        <div class="p-3 bg-primary/5 text-primary">
                            <span class="material-symbols-outlined text-2xl">restaurant</span>
                        </div>
                    </div>
                    
                    <!-- Card 2: Total Guests -->
                    <div class="bg-surface-variant/20 border border-primary/10 p-6 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-primary/60 font-semibold mb-1">Total Guests</p>
                            <h3 class="font-serif-headline text-3xl font-bold italic text-primary"><?php echo $totalGuests; ?></h3>
                        </div>
                        <div class="p-3 bg-primary/5 text-primary">
                            <span class="material-symbols-outlined text-2xl">group</span>
                        </div>
                    </div>

                    <!-- Card 3: Contacts / Correspondence -->
                    <div class="bg-surface-variant/20 border border-primary/10 p-6 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-primary/60 font-semibold mb-1">Inquiries</p>
                            <h3 class="font-serif-headline text-3xl font-bold italic text-primary"><?php echo $totalContacts; ?></h3>
                        </div>
                        <div class="p-3 bg-primary/5 text-primary">
                            <span class="material-symbols-outlined text-2xl">forum</span>
                        </div>
                    </div>

                    <!-- Card 4: Operating Status -->
                    <div class="bg-surface-variant/20 border border-primary/10 p-6 flex items-center justify-between">
                        <div>
                            <p class="text-xs uppercase tracking-widest text-primary/60 font-semibold mb-1">Atelier Status</p>
                            <h3 class="font-serif-headline text-lg font-bold italic text-emerald-800 flex items-center space-x-1 mt-2">
                                <span class="h-2.5 w-2.5 bg-emerald-700 rounded-full inline-block animate-pulse mr-2"></span>
                                Live Syncing
                            </h3>
                        </div>
                        <div class="p-3 bg-primary/5 text-primary">
                            <span class="material-symbols-outlined text-2xl">sync</span>
                        </div>
                    </div>
                </div>

                <!-- Database Error Message if Any -->
                <?php if (isset($dbError)): ?>
                    <div class="bg-amber-100 border border-amber-300 text-amber-900 px-6 py-4 rounded-none shadow-sm flex items-start space-x-3">
                        <span class="material-symbols-outlined text-amber-700">warning</span>
                        <div>
                            <h4 class="font-bold">Database Error Connection</h4>
                            <p class="text-sm"><?php echo htmlspecialchars($dbError); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Table Section: Reservations Tab -->
                <div id="section-reservations" class="tab-content bg-surface p-6 md:p-8 border border-primary/10 shadow-[0_20px_40px_rgba(61,38,28,0.03)]">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h2 class="font-serif-headline text-2xl text-primary font-bold italic">Guests & Reservations</h2>
                            <p class="text-xs text-primary/60 uppercase tracking-widest">Complete dining book details</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-primary/60 font-light" id="reservations-count-display">Showing all <?php echo $totalReservations; ?> entries</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-primary/20 text-xs font-semibold uppercase tracking-wider text-primary/70">
                                    <th class="py-4 px-4">ID</th>
                                    <th class="py-4 px-4">Name</th>
                                    <th class="py-4 px-4">Contact Info</th>
                                    <th class="py-4 px-4">Date &amp; Time</th>
                                    <th class="py-4 px-4 text-center">Guests</th>
                                    <th class="py-4 px-4">Occasion</th>
                                    <th class="py-4 px-4">Special Requests</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/10 text-primary/90" id="reservations-table-body">
                                <?php if ($totalReservations === 0): ?>
                                    <tr class="no-records-row">
                                        <td colspan="7" class="py-10 text-center text-primary/40 italic">
                                            No reservations found in the database.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($reservations as $res): ?>
                                        <tr class="hover:bg-primary/5 transition-colors duration-150 data-row" 
                                            data-searchable="<?php echo htmlspecialchars(strtolower(($res['name'] ?? '') . ' ' . ($res['email'] ?? '') . ' ' . ($res['phone'] ?? '') . ' ' . ($res['occasion'] ?? '') . ' ' . ($res['sp_requests'] ?? ''))); ?>">
                                            <td class="py-4 px-4 font-mono text-xs text-primary/50">#<?php echo htmlspecialchars($res['id'] ?? ''); ?></td>
                                            <td class="py-4 px-4 font-bold text-primary"><?php echo htmlspecialchars($res['name'] ?? ''); ?></td>
                                            <td class="py-4 px-4">
                                                <div class="flex flex-col">
                                                    <span class="font-medium"><?php echo htmlspecialchars($res['email'] ?? ''); ?></span>
                                                    <span class="text-xs text-primary/60"><?php echo htmlspecialchars($res['phone'] ?? ''); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <div class="flex flex-col">
                                                    <span class="font-medium"><?php echo htmlspecialchars($res['prefered_date'] ?? ''); ?></span>
                                                    <span class="text-xs text-primary/60"><?php echo htmlspecialchars($res['time'] ?? ''); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4 text-center">
                                                <span class="inline-block bg-primary/10 text-primary font-bold px-2.5 py-1 text-xs">
                                                    <?php echo htmlspecialchars($res['guests'] ?? '0'); ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="text-xs uppercase tracking-wider font-semibold border border-primary/20 px-2 py-1 bg-surface-variant/30 text-primary/80">
                                                    <?php echo htmlspecialchars($res['occasion'] ?? 'Casual'); ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 max-w-xs truncate" title="<?php echo htmlspecialchars($res['sp_requests'] ?? ''); ?>">
                                                <span class="text-xs font-light leading-relaxed italic">
                                                    <?php echo htmlspecialchars($res['sp_requests'] ?? 'None'); ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Table Section: Contacts Tab -->
                <div id="section-contacts" class="tab-content hidden bg-surface p-6 md:p-8 border border-primary/10 shadow-[0_20px_40px_rgba(61,38,28,0.03)]">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                        <div>
                            <h2 class="font-serif-headline text-2xl text-primary font-bold italic">Correspondence &amp; Inquiries</h2>
                            <p class="text-xs text-primary/60 uppercase tracking-widest">Customer feedback &amp; messaging</p>
                        </div>
                        <div class="text-right">
                            <span class="text-xs text-primary/60 font-light" id="contacts-count-display">Showing all <?php echo $totalContacts; ?> entries</span>
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="border-b border-primary/20 text-xs font-semibold uppercase tracking-wider text-primary/70">
                                    <th class="py-4 px-4">ID</th>
                                    <th class="py-4 px-4">Name</th>
                                    <th class="py-4 px-4">Contact Info</th>
                                    <th class="py-4 px-4">Nature of Inquiry</th>
                                    <th class="py-4 px-4">Message</th>
                                    <th class="py-4 px-4">Date Submitted</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-primary/10 text-primary/90" id="contacts-table-body">
                                <?php if ($totalContacts === 0): ?>
                                    <tr class="no-records-row">
                                        <td colspan="6" class="py-10 text-center text-primary/40 italic">
                                            No inquiries found in the database.
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($contacts as $cont): ?>
                                        <tr class="hover:bg-primary/5 transition-colors duration-150 data-row"
                                            data-searchable="<?php echo htmlspecialchars(strtolower(($cont['name'] ?? '') . ' ' . ($cont['email'] ?? '') . ' ' . ($cont['phone'] ?? '') . ' ' . ($cont['inquiry'] ?? '') . ' ' . ($cont['massage'] ?? ''))); ?>">
                                            <td class="py-4 px-4 font-mono text-xs text-primary/50">#<?php echo htmlspecialchars($cont['id'] ?? ''); ?></td>
                                            <td class="py-4 px-4 font-bold text-primary"><?php echo htmlspecialchars($cont['name'] ?? ''); ?></td>
                                            <td class="py-4 px-4">
                                                <div class="flex flex-col">
                                                    <span class="font-medium"><?php echo htmlspecialchars($cont['email'] ?? ''); ?></span>
                                                    <span class="text-xs text-primary/60"><?php echo htmlspecialchars($cont['phone'] ?? ''); ?></span>
                                                </div>
                                            </td>
                                            <td class="py-4 px-4">
                                                <span class="text-xs uppercase tracking-wider font-semibold border border-primary/20 px-2.5 py-1 bg-surface-variant/30 text-primary/80">
                                                    <?php echo htmlspecialchars($cont['inquiry'] ?? 'General'); ?>
                                                </span>
                                            </td>
                                            <td class="py-4 px-4 max-w-sm truncate whitespace-normal text-xs font-light leading-relaxed" title="<?php echo htmlspecialchars($cont['massage'] ?? ''); ?>">
                                                <?php echo htmlspecialchars($cont['massage'] ?? ''); ?>
                                            </td>
                                            <td class="py-4 px-4 text-xs text-primary/60">
                                                <?php echo htmlspecialchars($cont['created_at'] ?? ''); ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>
<?php endif; ?>

<!-- Script Logic for Tab Management and Search Engine -->
<script>
    let currentTab = 'reservations';

    function switchTab(tabName) {
        currentTab = tabName;
        
        // Hide all tabs
        document.querySelectorAll('.tab-content').forEach(element => {
            element.classList.add('hidden');
        });
        
        // Show selected tab
        const activeSection = document.getElementById(`section-${tabName}`);
        if (activeSection) {
            activeSection.classList.remove('hidden');
        }

        // Toggle button styles
        const btnRes = document.getElementById('btn-reservations');
        const btnCont = document.getElementById('btn-contacts');

        if (tabName === 'reservations') {
            btnRes.className = "tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium bg-secondary text-primary hover:bg-secondary transition-all duration-300";
            btnCont.className = "tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium text-secondary hover:bg-primary-container transition-all duration-300";
        } else {
            btnRes.className = "tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium text-secondary hover:bg-primary-container transition-all duration-300";
            btnCont.className = "tab-btn w-full flex items-center space-x-3 px-4 py-3.5 text-sm uppercase tracking-wider font-medium bg-secondary text-primary hover:bg-secondary transition-all duration-300";
        }

        // Clear search input and re-filter
        document.getElementById('dashboard-search').value = '';
        performSearch();
    }

    function performSearch() {
        const query = document.getElementById('dashboard-search').value.toLowerCase().trim();
        const activeTableBody = document.getElementById(`${currentTab}-table-body`);
        if (!activeTableBody) return;

        const rows = activeTableBody.querySelectorAll('.data-row');
        let visibleCount = 0;

        rows.forEach(row => {
            const searchableText = row.getAttribute('data-searchable') || '';
            if (query === '' || searchableText.includes(query)) {
                row.classList.remove('hidden');
                visibleCount++;
            } else {
                row.classList.add('hidden');
            }
        });

        // Handle empty state row if no visible rows left
        let noRecordsRow = activeTableBody.querySelector('.no-records-search-row');
        if (visibleCount === 0 && rows.length > 0) {
            if (!noRecordsRow) {
                noRecordsRow = document.createElement('tr');
                noRecordsRow.className = 'no-records-search-row';
                const colCount = currentTab === 'reservations' ? 7 : 6;
                noRecordsRow.innerHTML = `
                    <td colspan="${colCount}" class="py-10 text-center text-primary/40 italic">
                        No matches found for "${query}"
                    </td>
                `;
                activeTableBody.appendChild(noRecordsRow);
            }
        } else if (noRecordsRow) {
            noRecordsRow.remove();
        }

        // Update display counter
        const countDisplay = document.getElementById(`${currentTab}-count-display`);
        if (countDisplay) {
            if (query === '') {
                countDisplay.textContent = `Showing all ${rows.length} entries`;
            } else {
                countDisplay.textContent = `Found ${visibleCount} matches of ${rows.length}`;
            }
        }
    }
</script>
</body>
</html>
