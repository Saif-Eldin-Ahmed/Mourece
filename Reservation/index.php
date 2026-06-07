<?php
require_once "../dashboard/db.php";

$message = '';
$messageType = ''; // 'success' or 'error'

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phoneStr = trim($_POST['phone'] ?? '');
    $prefered_date = trim($_POST['prefered_date'] ?? '');
    $time = trim($_POST['time'] ?? '');
    $guests = intval($_POST['guests'] ?? 2);
    $occasion = trim($_POST['occasion'] ?? 'Casual Dining');
    $sp_requests = trim($_POST['sp_requests'] ?? '');

    // Strip non-digits from phone for int column representation
    $phone = intval(preg_replace('/[^0-9]/', '', $phoneStr));

    if (empty($name) || empty($email) || empty($phoneStr) || empty($prefered_date) || empty($time)) {
        $message = "Please complete all required fields.";
        $messageType = "error";
    } else {
        try {
            $pdo = getDBConnection();
            $stmt = $pdo->prepare("INSERT INTO reservations (`name`, `email`, `phone`, `prefered_date`, `time`, `guests`, `occasion`, `sp_requests`) VALUES (:name, :email, :phone, :prefered_date, :time, :guests, :occasion, :sp_requests)");
            $stmt->execute([':name' => $name, ':email' => $email, ':phone' => $phone, ':prefered_date' => $prefered_date, ':time' => $time, ':guests' => $guests, ':occasion' => $occasion, ':sp_requests' => $sp_requests]);
            $message = "Your reservation has been confirmed. We look forward to welcoming you.";
            $messageType = "success";
        } catch (Exception $e) {
            $message = "Error booking reservation: " . $e->getMessage();
            $messageType = "error";
        }
    }
}

include("../Includes/blocks/header.php");
?>

<!-- Hero Section: Updated to match Homepage SCREEN_31 style -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img alt="Luxurious restaurant interior" class="w-full h-full object-cover object-center" src="../Includes/images/heritage_dining.jpg" />
        <!-- Gradient Overlay transitioning to background beige -->
        <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/30 to-surface"></div>
    </div>
    <div class="relative z-10 text-center px-6 max-w-4xl">
        <h1 class="font-headline text-5xl md:text-8xl text-on-primary mb-6 tracking-tight font-bold italic">
            Secure Your Table at the Atelier
        </h1>
    </div>
    <!-- Scroll indicator matching SCREEN_31 -->
    <div class="absolute bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4 text-on-primary/60">
        <span class="text-[10px] uppercase tracking-[0.4em]">Scroll to Explore</span>
        <div class="w-[1px] h-12 bg-gradient-to-b from-on-primary/60 to-transparent"></div>
    </div>
</section>
<!-- Main Content Area -->
<main class="relative z-20 bg-surface py-32 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
            <!-- Reservation Form Column -->
            <div class="lg:col-span-7 bg-surface p-8 md:p-12 shadow-[0_40px_80px_rgba(51,22,16,0.1)] border border-primary/20 relative overflow-hidden">
                <div class="ornate-pattern absolute inset-0 pointer-events-none"></div>

                <?php if (!empty($message)): ?>
                    <div class="mb-8 p-5 border <?php echo $messageType === 'success' ? 'bg-emerald-950/20 border-emerald-800 text-emerald-800' : 'bg-red-950/20 border-red-800 text-red-800'; ?> flex items-start space-x-3">
                        <span class="material-symbols-outlined"><?php echo $messageType === 'success' ? 'check_circle' : 'error'; ?></span>
                        <div>
                            <p class="font-semibold text-sm uppercase tracking-wider"><?php echo $messageType === 'success' ? 'Success' : 'Attention'; ?></p>
                            <p class="text-xs mt-1 leading-relaxed"><?php echo htmlspecialchars($message); ?></p>
                        </div>
                    </div>
                <?php endif; ?>

                <form method="POST" action="index.php" class="relative z-10 space-y-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                        <!-- Date Selection -->
                        <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                            <label class="text-xs font-label uppercase tracking-widest text-primary/60">Preferred Date</label>
                            <div class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">calendar_today</span>
                                <input name="prefered_date" required class="w-full bg-transparent border-none p-0 font-body text-lg text-primary focus:ring-0" type="date" />
                            </div>
                        </div>
                        <!-- Guest Count -->
                        <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                            <label class="text-xs font-label uppercase tracking-widest text-primary/60">Party Size</label>
                            <div class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">group</span>
                                <select name="guests" class="w-full bg-transparent border-none p-0 font-body text-lg text-primary appearance-none focus:ring-0">
                                    <option value="2">2 Guests</option>
                                    <option value="4">4 Guests</option>
                                    <option value="6">6 Guests</option>
                                    <option value="8">Private Atelier (8+)</option>
                                </select>
                            </div>
                        </div>
                        <!-- Time Selection -->
                        <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                            <label class="text-xs font-label uppercase tracking-widest text-primary/60">Arrival Time</label>
                            <div class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">schedule</span>
                                <select name="time" class="w-full bg-transparent border-none p-0 font-body text-lg text-primary appearance-none focus:ring-0">
                                    <option value="18:30:00">18:30 — Evening Service</option>
                                    <option value="19:00:00">19:00 — Evening Service</option>
                                    <option value="20:30:00">20:30 — Late Service</option>
                                    <option value="21:00:00">21:00 — Late Service</option>
                                </select>
                            </div>
                        </div>
                        <!-- Occasion -->
                        <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                            <label class="text-xs font-label uppercase tracking-widest text-primary/60">Occasion</label>
                            <div class="flex items-center">
                                <span class="material-symbols-outlined text-primary mr-3">celebration</span>
                                <select name="occasion" class="w-full bg-transparent border-none p-0 font-body text-lg text-primary appearance-none focus:ring-0">
                                    <option value="Casual Dining">Casual Dining</option>
                                    <option value="Anniversary">Anniversary</option>
                                    <option value="Business Meeting">Business Meeting</option>
                                    <option value="Birthday">Birthday</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- Special Requests -->
                    <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                        <label class="text-xs font-label uppercase tracking-widest text-primary/60">Dietary Requirements &amp; Special Requests</label>
                        <textarea name="sp_requests" class="w-full bg-transparent border-none p-0 font-body text-lg text-primary placeholder:text-primary/30 resize-none focus:ring-0" placeholder="Tell us about allergies or specific table preferences..." rows="2"></textarea>
                    </div>
                    <!-- Contact Details -->
                    <div class="pt-6 space-y-10">
                        <h3 class="font-headline text-2xl text-primary font-bold italic">Contact Details</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-10">
                            <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                                <label class="text-xs font-label uppercase tracking-widest text-primary/60">Full Name</label>
                                <input name="name" required class="w-full bg-transparent border-none p-0 font-body text-lg text-primary focus:ring-0" placeholder="Azeezah Al-Saud" type="text" />
                            </div>
                            <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                                <label class="text-xs font-label uppercase tracking-widest text-primary/60">Email Address</label>
                                <input name="email" required class="w-full bg-transparent border-none p-0 font-body text-lg text-primary focus:ring-0" placeholder="heritage@mourece.com" type="email" />
                            </div>
                            <div class="flex flex-col space-y-2 border-b border-primary/30 pb-2">
                                <label class="text-xs font-label uppercase tracking-widest text-primary/60">Phone Number</label>
                                <input name="phone" required class="w-full bg-transparent border-none p-0 font-body text-lg text-primary focus:ring-0" placeholder="96612345678" type="tel" />
                            </div>
                        </div>
                    </div>
                    <div class="pt-8">
                        <button class="w-full bg-primary text-on-primary py-5 font-label tracking-widest uppercase text-sm hover:opacity-90 transition-opacity flex items-center justify-center space-x-3 group" type="submit">
                            <span>Confirm</span>
                            <span class="material-symbols-outlined text-sm group-hover:translate-x-2 transition-transform">arrow_forward</span>
                        </button>
                    </div>
                </form>
            </div>
            <!-- Info Column: The Experience Section -->
            <div class="lg:col-span-5 space-y-12">
                <div class="bg-surface p-10 border border-primary/20">
                    <h2 class="font-headline text-3xl text-primary mb-8 border-b border-primary/40 pb-4 inline-block italic">The Experience</h2>
                    <div class="space-y-8">
                        <div class="flex items-start space-x-5">
                            <span class="material-symbols-outlined text-primary pt-1">timer</span>
                            <div>
                                <h4 class="font-label text-sm font-bold uppercase tracking-wider text-primary mb-1">Dining Duration</h4>
                                <p class="text-primary/80 font-light text-sm leading-relaxed">
                                    To ensure every guest experiences the full artisanal narrative, we allocate 2.5 hours for each booking.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-5">
                            <span class="material-symbols-outlined text-primary pt-1">verified_user</span>
                            <div>
                                <h4 class="font-label text-sm font-bold uppercase tracking-wider text-primary mb-1">Artisanal Nature</h4>
                                <p class="text-primary/80 font-light text-sm leading-relaxed">
                                    Our ingredients are sourced daily. Please note that certain rare dishes may have limited availability.
                                </p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-5">
                            <span class="material-symbols-outlined text-primary pt-1">event_busy</span>
                            <div>
                                <h4 class="font-label text-sm font-bold uppercase tracking-wider text-primary mb-1">Cancellation Policy</h4>
                                <p class="text-primary/80 font-light text-sm leading-relaxed">
                                    We request a minimum of 24 hours notice for cancellations. Group bookings of 6+ require 48 hours notice.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Map & Location -->
                <div class="bg-primary/10 p-4 h-64 relative group overflow-hidden border border-primary/10">
                    <div class="absolute inset-0 bg-surface">
                        <img class="w-full h-full object-cover mix-blend-multiply opacity-40" data-alt="Map view" data-location="Riyadh" src="../Includes/images/map_riyadh.jpg" />
                    </div>
                    <div class="relative z-10 h-full flex flex-col justify-end p-6 bg-gradient-to-t from-primary/80 to-transparent text-on-primary">
                        <h3 class="font-headline text-xl mb-1 italic">Mourece Atelier</h3>
                        <p class="text-xs uppercase tracking-widest font-light">Heritage District, Block 12, Riyadh</p>
                    </div>
                </div>
                <!-- Contact Details -->
                <div class="space-y-4 px-2">
                    <div class="flex justify-between items-center text-sm border-b border-primary/10 pb-2">
                        <span class="text-primary/60 uppercase tracking-widest text-[10px]">Direct Line</span>
                        <span class="text-primary font-medium">+966 11 456 7890</span>
                    </div>
                    <div class="flex justify-between items-center text-sm border-b border-primary/10 pb-2">
                        <span class="text-primary/60 uppercase tracking-widest text-[10px]">Email Enquiries</span>
                        <span class="text-primary font-medium">atelier@mourece.com</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->
<?php include("../Includes/blocks/footer.php"); ?>
</body>

</html>