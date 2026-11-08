{{-- REALORNOT AI: interactive 3D face scanner --}}
<div data-face-scanner class="w-full space-y-3">
    <div data-face-stage
        class="relative isolate aspect-[4/3] min-h-[520px] max-h-[760px] overflow-hidden lg:-translate-x-10">

        <canvas data-face-canvas
            aria-label="Pemindai wajah 3D interaktif"
            role="img"
            class="absolute inset-0 block h-full w-full touch-pan-y"></canvas>

        {{-- HUD labels --}}
        
        <div class="pointer-events-none absolute bottom-4 right-20 z-30 font-mono text-[9px] tracking-wider text-[#FF2D55] sm:text-[10px]" data-face-alert aria-live="polite"></div>

        {{-- Static scanline texture (no animated background layer) --}}
        <div aria-hidden="true"
            class="pointer-events-none absolute inset-0 z-[10] opacity-[0.12]"
            style="background:repeating-linear-gradient(to bottom, transparent 0px, transparent 3px, rgba(0,0,0,.65) 4px);"></div>

       
    </div>


</div>

{{-- Muat sekali saja. Jika sudah dimasukkan ke layout utama, hapus baris ini dari partial. --}}
<script src="{{ asset('js/realornot-face-scanner.js') }}" defer></script>
