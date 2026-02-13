/**
 * EduTech Project: Slider & Header Logic
 * Handles scroll effects and dual-typing animations
 */

// --- 1. Header Scroll Effect ---
window.addEventListener('scroll', function() {
    const navbar = document.getElementById('navbar');
    // Triggers the background change after 50px of scrolling
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// --- 2. Central CTA Typing Logic ---
const ctaText = "Get Your Dream Colleges Here";
const ctaElement = document.getElementById('cta-typing');
let ctaIndex = 0;

function typeCTA() {
    if (ctaIndex < ctaText.length) {
        ctaElement.innerHTML += ctaText.charAt(ctaIndex);
        ctaIndex++;
        // Speed for central message (approx 100ms per char)
        setTimeout(typeCTA, 100);
    } else {
        // Wait 3 seconds then restart the central typing cycle
        setTimeout(() => {
            ctaElement.innerHTML = "";
            ctaIndex = 0;
            typeCTA();
        }, 3000);
    }
}

// --- 3. Slider & Corner Typing Logic ---
let currentSlide = 0;
const slides = document.querySelectorAll('.slide');

function startSlider() {
    if (slides.length === 0) return;

    // Remove active class and clear previous corner text
    slides.forEach(s => {
        s.classList.remove('active');
        const tag = s.querySelector('.college-name-tag');
        if (tag) tag.innerHTML = "";
    });

    // Set the new active slide
    const activeSlide = slides[currentSlide];
    activeSlide.classList.add('active');

    // Start typing the college name in the bottom right corner
    const nameTag = activeSlide.querySelector('.college-name-tag');
    const nameToType = nameTag.getAttribute('data-name');
    
    // Type out the corner name (fast speed: 50ms per char)
    typeCornerName(nameToType, 0, nameTag);

    // Change slide every 5 seconds
    setTimeout(() => {
        currentSlide = (currentSlide + 1) % slides.length;
        startSlider();
    }, 5000);
}

function typeCornerName(text, i, element) {
    if (i < text.length) {
        element.innerHTML += text.charAt(i);
        setTimeout(() => typeCornerName(text, i + 1, element), 50);
    }
}

// --- 4. Initialization ---
window.addEventListener('load', () => {
    // Start central typing
    if (ctaElement) typeCTA();
    
    // Start slider and corner labels
    if (slides.length > 0) startSlider();
});