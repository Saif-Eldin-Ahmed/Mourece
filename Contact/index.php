<?php include("../Includes/blocks/header.php"); ?>

<main class="pt-0">
  <!-- Hero Section -->
  <section
    class="relative flex items-center justify-center overflow-hidden h-screen">
    <div class="absolute inset-0 z-0">
      <img
        class="w-full h-full object-cover"
        data-alt="Intimate candlelit dining room with textured plaster walls, heavy wooden tables, and soft warm lighting in an old heritage building."
        src="../Includes/images/heritage_dining.jpg" />
      <div
        class="absolute inset-0 bg-gradient-to-b from-primary/60 via-primary/30 to-surface"></div>
    </div>
    <div class="relative z-10 text-center px-6">
      <h1
        class="font-headline text-5xl md:text-7xl lg:text-8xl text-on-primary font-bold tracking-tight mb-6 italic">
        Connect with the Atelier
      </h1>
      <div class="w-24 h-px bg-secondary mx-auto"></div>
    </div>
    <div
      class="absolute bottom-8 md:bottom-12 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4 text-on-primary/60">
      <span class="text-[10px] uppercase tracking-[0.4em]">Scroll to Explore</span>
      <div
        class="w-[1px] h-8 md:h-12 bg-gradient-to-b from-on-primary/60 to-transparent"></div>
    </div>
  </section>
  <!-- Main Content Grid -->
  <section class="max-w-7xl mx-auto px-6 md:px-12 py-24">
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
      <!-- Contact Form Section -->
      <div
        class="lg:col-span-7 bg-surface-variant/30 p-8 md:p-16 relative overflow-hidden border border-primary/10">
        <div
          class="absolute top-0 right-0 w-64 h-64 bg-pattern -mr-20 -mt-20"></div>
        <h2 class="font-headline text-3xl mb-12 relative z-10 text-primary">
          Inquiries &amp; Correspondence
        </h2>
        <form class="space-y-12 relative z-10">
          <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <div class="relative">
              <input
                class="peer w-full bg-transparent border-0 border-b border-primary/20 py-3 focus:ring-0 focus:border-primary transition-colors placeholder-transparent"
                id="name"
                placeholder=" "
                type="text" />
              <label
                class="absolute left-0 -top-3.5 text-primary/50 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-primary peer-focus:text-sm uppercase tracking-widest font-label"
                for="name">Full Name</label>
            </div>
            <div class="relative">
              <input
                class="peer w-full bg-transparent border-0 border-b border-primary/20 py-3 focus:ring-0 focus:border-primary transition-colors placeholder-transparent"
                id="email"
                placeholder=" "
                type="email" />
              <label
                class="absolute left-0 -top-3.5 text-primary/50 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-primary peer-focus:text-sm uppercase tracking-widest font-label"
                for="email">Email Address</label>
            </div>
          </div>
          <div class="relative">
            <input
              class="peer w-full bg-transparent border-0 border-b border-primary/20 py-3 focus:ring-0 focus:border-primary transition-colors placeholder-transparent"
              id="subject"
              placeholder=" "
              type="text" />
            <label
              class="absolute left-0 -top-3.5 text-primary/50 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-primary peer-focus:text-sm uppercase tracking-widest font-label"
              for="subject">Nature of Inquiry</label>
          </div>
          <div class="relative">
            <textarea
              class="peer w-full bg-transparent border-0 border-b border-primary/20 py-3 focus:ring-0 focus:border-primary transition-colors placeholder-transparent resize-none"
              id="message"
              placeholder=" "
              rows="4"></textarea>
            <label
              class="absolute left-0 -top-3.5 text-primary/50 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:top-3 peer-focus:-top-3.5 peer-focus:text-primary peer-focus:text-sm uppercase tracking-widest font-label"
              for="message">Message</label>
          </div>
          <button
            class="group flex items-center space-x-4 bg-primary text-on-primary px-10 py-5 font-label text-xs uppercase tracking-[0.3em] hover:bg-primary-container transition-all"
            type="submit">
            <span>Send Message</span>
            <span
              class="material-symbols-outlined text-sm group-hover:translate-x-1 transition-transform">arrow_forward</span>
          </button>
        </form>
      </div>
      <!-- Info Sidebar -->
      <div class="lg:col-span-5 space-y-16">
        <!-- Location & Contact -->
        <div class="space-y-8">
          <div>
            <h3
              class="font-label text-xs uppercase tracking-[0.4em] text-primary/70 mb-6">
              Our Location
            </h3>
            <p
              class="font-headline text-2xl leading-relaxed text-primary italic">
              42 Al-Muallem District,<br />
              Heritage Quarter, Jeddah 23431<br />
              Saudi Arabia
            </p>
          </div>
          <div
            class="flex flex-col space-y-4 font-body text-lg text-primary/80">
            <a
              class="hover:text-primary transition-colors flex items-center gap-3"
              href="tel:+966123456789">
              <span class="material-symbols-outlined text-primary">call</span>
              +966 12 345 6789
            </a>
            <a
              class="hover:text-primary transition-colors flex items-center gap-3"
              href="mailto:concierge@mourece.com">
              <span class="material-symbols-outlined text-primary">mail</span>
              concierge@mourece.com
            </a>
          </div>
        </div>
        <!-- Hours -->
        <div class="bg-primary/5 p-8 border-l-2 border-primary/20">
          <h3
            class="font-label text-xs uppercase tracking-[0.4em] text-primary/70 mb-8">
            Operating Hours
          </h3>
          <div class="space-y-4">
            <div
              class="flex justify-between items-center border-b border-primary/10 pb-4">
              <span class="font-label text-sm uppercase tracking-widest">Monday - Thursday</span>
              <span class="font-headline italic">18:00 — 23:00</span>
            </div>
            <div
              class="flex justify-between items-center border-b border-primary/10 pb-4">
              <span class="font-label text-sm uppercase tracking-widest">Friday - Saturday</span>
              <span class="font-headline italic">17:00 — 00:00</span>
            </div>
            <div class="flex justify-between items-center">
              <span class="font-label text-sm uppercase tracking-widest">Sunday</span>
              <span class="font-headline italic">Closed</span>
            </div>
          </div>
        </div>
        <!-- Atmospheric Detail -->
        <div class="relative h-64 w-full overflow-hidden">
          <img
            class="w-full h-full object-cover"
            data-alt="Close-up of artisan calligraphy ink and a traditional reed pen on a stone desk with warm sunlight streaming across."
            src="../Includes/images/heritage_craftsmanship.jpg" />
          <div class="absolute inset-0 bg-primary/20"></div>
        </div>
      </div>
    </div>
  </section>
  <!-- Map Section / Full Width Atmospheric -->
  <section class="w-full h-[500px] relative bg-surface-variant/20 h-screen">
    <div
      class="absolute inset-0 opacity-20 grayscale contrast-125"
      data-alt="Abstract architectural map-like view of a traditional Arabic city with dense geometric patterns and sandy tones."
      style="
            background-image: url(&quot;../Includes/images/abstract_map.jpg&quot;);
            background-position: center;
            background-size: cover;
          "></div>
    <div
      class="absolute inset-0 bg-gradient-to-t from-surface via-transparent to-surface"></div>
    <div class="absolute inset-0 flex items-center justify-center">
      <div
        class="bg-surface/90 backdrop-blur px-12 py-16 text-center border border-primary/10 shadow-2xl">
        <span
          class="material-symbols-outlined text-4xl text-primary mb-4"
          style="font-variation-settings: 'FILL' 1;">location_on</span>
        <h4 class="font-headline text-2xl mb-2 italic">Find Your Way</h4>
        <p class="font-body text-primary/60 mb-8 max-w-xs">
          Valet parking is available at the Heritage Quarter main entrance.
        </p>
        <a
          class="inline-block border border-primary px-8 py-3 font-label text-xs uppercase tracking-widest hover:bg-primary hover:text-on-primary transition-all"
          href="#">Get Directions</a>
      </div>
    </div>
  </section>
</main>
<!-- Footer -->
<?php include("../Includes/blocks/footer.php"); ?>
</body>

</html>