<?php include("../Includes/blocks/header.php"); ?>

<main class="pt-0">
    <!-- Hero Section -->
    <section class="relative h-[80vh] md:h-screen flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img alt="Artisanal Heritage Dining" class="w-full h-full object-cover object-center" src="../Includes/images/heritage_dining.jpg" />
            <div class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/30 to-surface"></div>
        </div>
        <div class="relative z-10 text-center px-8 max-w-4xl">
            <h1 class="font-headline text-4xl md:text-7xl lg:text-8xl text-on-primary mb-6 tracking-tight font-bold italic">
                A Step into Heritage
            </h1>
            <p class="font-body text-lg md:text-xl text-on-primary/90 mb-10 max-w-2xl mx-auto font-light leading-relaxed">
                Rediscover the soul of the Levant through artisanal precision and centuries of culinary craftsmanship.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 md:gap-6 justify-center">
                <a href="../Reservation/" class="bg-primary text-on-primary px-8 md:px-10 py-4 md:py-5 font-label uppercase tracking-[0.2em] text-xs md:text-sm hover:bg-primary-container transition-all duration-500 shadow-xl">
                    Book Your Experience
                </a>
                <a href="../Menu/" class="border border-on-primary/30 backdrop-blur-md text-on-primary px-8 md:px-10 py-4 md:py-5 font-label uppercase tracking-[0.2em] text-xs md:text-sm hover:bg-on-primary/10 transition-all duration-500">
                    View The Menu
                </a>
            </div>
        </div>
        <div class="absolute bottom-8 md:bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4 text-on-primary/60">
            <span class="text-[10px] uppercase tracking-[0.4em]">Scroll to Explore</span>
            <div class="w-[1px] h-8 md:h-12 bg-gradient-to-b from-on-primary/60 to-transparent"></div>
        </div>
    </section>
    <!-- Our Menu Section -->
    <section class="py-20 md:py-32 px-8 md:px-12 bg-surface overflow-hidden pattern-overlay">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 md:mb-24 gap-8">
                <div class="max-w-2xl">
                    <span class="text-primary/70 font-label uppercase tracking-[0.3em] text-xs md:text-sm mb-4 block">The Curated Collection</span>
                    <h2 class="font-headline text-4xl md:text-6xl text-primary font-bold">The Artisanal Menu</h2>
                </div>
                <a class="group flex items-center gap-4 text-primary font-label uppercase tracking-widest text-xs md:text-sm border-b border-primary/20 pb-2" href="#">
                    View Full Menu
                    <span class="material-symbols-outlined transition-transform group-hover:translate-x-1" data-icon="arrow_forward">arrow_forward</span>
                </a>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-16 tablet-menu-grid">
                <!-- Menu Item 1 -->
                <div class="group">
                    <div class="aspect-[4/5] mb-6 md:mb-8 overflow-hidden bg-primary/5">
                        <img alt="Silk Hummus" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="../Includes/images/silk_hummus.jpg" />
                    </div>
                    <div class="flex justify-between items-baseline mb-2">
                        <h3 class="font-headline text-xl md:text-2xl text-primary">Silk Hummus</h3>
                        <span class="text-primary font-body font-bold">85</span>
                    </div>
                    <p class="text-on-surface-variant font-light leading-relaxed italic mb-4 text-sm md:text-base">
                        Micro-filtered chickpeas, roasted pine nuts, cold-pressed artisanal olive oil from the groves of Akkar.
                    </p>
                    <div class="w-12 h-[1px] bg-primary/40"></div>
                </div>
                <!-- Menu Item 2 -->
                <div class="group md:mt-12 lg:mt-24">
                    <div class="aspect-[4/5] mb-6 md:mb-8 overflow-hidden bg-primary/5">
                        <img alt="Heritage Lamb" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="../Includes/images/kofta_siyahi.jpg" />
                    </div>
                    <div class="flex justify-between items-baseline mb-2">
                        <h3 class="font-headline text-xl md:text-2xl text-primary">Kofta Siyahi</h3>
                        <span class="text-primary font-body font-bold">145</span>
                    </div>
                    <p class="text-on-surface-variant font-light leading-relaxed italic mb-4 text-sm md:text-base">
                        Hand-minced prime lamb, seven heritage spices, charred heirloom tomatoes over oak embers.
                    </p>
                    <div class="w-12 h-[1px] bg-primary/40"></div>
                </div>
                <!-- Menu Item 3 -->
                <div class="group tablet-menu-item-3 lg:mt-0">
                    <div class="aspect-[4/5] mb-6 md:mb-8 overflow-hidden bg-primary/5">
                        <img alt="Sumac Ruby Salad" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-105" src="../Includes/images/ruby_tabbouleh.jpg" />
                    </div>
                    <div class="flex justify-between items-baseline mb-2">
                        <h3 class="font-headline text-xl md:text-2xl text-primary">Ruby Tabbouleh</h3>
                        <span class="text-primary font-body font-bold">75</span>
                    </div>
                    <p class="text-on-surface-variant font-light leading-relaxed italic mb-4 text-sm md:text-base">
                        Wild parsley, pomegranate pearls, hand-pressed lemon zest, and heritage sumac.
                    </p>
                    <div class="w-12 h-[1px] bg-primary/40"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- The Story Section: Heritage Atelier -->
    <section class="py-20 md:py-32 bg-primary/5 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-8 md:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 md:gap-24 items-center">
            <div class="relative">
                <div class="aspect-[3/4] overflow-hidden shadow-2xl">
                    <img alt="Heritage Craftsmanship" class="w-full h-full object-cover" src="../Includes/images/heritage_craftsmanship.jpg" />
                </div>
                <div class="absolute -bottom-8 -right-8 md:-bottom-12 md:-right-12 w-48 md:w-64 h-48 md:h-64 bg-primary p-6 md:p-8 flex flex-col justify-end text-on-primary shadow-2xl">
                    <p class="font-headline text-xl md:text-2xl italic leading-tight mb-4">"The soul is in the detail."</p>
                    <span class="font-label text-[10px] md:text-xs uppercase tracking-widest text-secondary">— Chef Azeezah</span>
                </div>
            </div>
            <div class="space-y-8 md:space-y-10 lg:pl-12">
                <span class="text-primary/70 font-label uppercase tracking-[0.3em] text-xs md:text-sm block">Our Legacy</span>
                <h2 class="font-headline text-4xl md:text-6xl lg:text-7xl text-primary leading-tight font-bold italic">The Heritage Atelier</h2>
                <p class="font-body text-base md:text-lg text-on-surface-variant leading-loose font-light">
                    Mourece is more than a restaurant; it is a workshop of history. We treat every ingredient as a sacred medium, applying ancestral techniques to modern palettes. Our kitchen operates as an atelier, where chefs are artisans and every plate is a curated dialogue between the past and the present.
                </p>
                <div class="grid grid-cols-2 gap-8 md:gap-12 pt-4 md:pt-8">
                    <div>
                        <h4 class="font-headline text-lg md:text-xl text-primary mb-2">Ancestral Sourcing</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant leading-relaxed">Direct relationships with small-scale heritage farmers across the Levant.</p>
                    </div>
                    <div>
                        <h4 class="font-headline text-lg md:text-xl text-primary mb-2">Aged Techniques</h4>
                        <p class="text-xs md:text-sm text-on-surface-variant leading-relaxed">Traditional pit-roasting and clay-pot fermentation practiced for generations.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Gallery: Bento Grid Style -->
    <section class="py-20 md:py-32 bg-surface">
        <div class="max-w-7xl mx-auto px-8 md:px-12">
            <div class="text-center mb-16 md:mb-24">
                <h2 class="font-headline text-4xl md:text-5xl text-primary mb-4">The Interior &amp; Soul</h2>
                <div class="w-20 md:w-24 h-[1px] bg-primary/40 mx-auto"></div>
            </div>
            <div class="grid grid-cols-4 grid-rows-2 gap-3 md:gap-4 h-[500px] md:tablet-gallery-height lg:h-[800px]">
                <div class="col-span-2 row-span-2 overflow-hidden bg-primary">
                    <img alt="Interior Grandeur" class="w-full h-full object-cover grayscale opacity-80 hover:opacity-100 hover:grayscale-0 transition-all duration-1000" src="../Includes/images/gallery_interior.jpg" />
                </div>
                <div class="col-span-2 row-span-1 overflow-hidden bg-primary">
                    <img alt="Mezze Array" class="w-full h-full object-cover grayscale opacity-80 hover:opacity-100 hover:grayscale-0 transition-all duration-1000" src="../Includes/images/gallery_mezze.jpg" />
                </div>
                <div class="col-span-1 row-span-1 overflow-hidden bg-primary">
                    <img alt="Artisan Fire" class="w-full h-full object-cover grayscale opacity-80 hover:opacity-100 hover:grayscale-0 transition-all duration-1000" src="../Includes/images/gallery_fire.jpg" />
                </div>
                <div class="col-span-1 row-span-1 overflow-hidden bg-primary">
                    <img alt="Coffee Ritual" class="w-full h-full object-cover grayscale opacity-80 hover:opacity-100 hover:grayscale-0 transition-all duration-1000" src="../Includes/images/gallery_coffee.jpg" />
                </div>
            </div>
        </div>
    </section>
</main>
<!-- Footer -->
<?php include("../Includes/blocks/footer.php"); ?>
<!-- Floating Reservation Bar (Signature Component - Mobile/Small Tablet Only) -->
<div class="fixed bottom-6 left-1/2 -translate-x-1/2 z-40 md:hidden w-[90%]">
    <div class="bg-surface/90 backdrop-blur-xl px-6 py-4 flex justify-between items-center shadow-2xl rounded-lg border border-primary/20">
        <div class="flex flex-col">
            <span class="text-[9px] font-label uppercase tracking-widest text-on-surface-variant">Heritage Dining</span>
            <span class="text-xs font-headline font-bold text-primary italic">Limited Tables</span>
        </div>
        <button class="bg-primary text-on-primary px-5 py-3 font-label text-[10px] uppercase tracking-widest rounded-sm">
            Book Now
        </button>
    </div>
</div>
</body>

</html>