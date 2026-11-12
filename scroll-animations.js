/*Scroll-triggered anime.js animations, shared by the portfolio and the CV.
  Each page names its targets as CSS selectors on the script tag: data-rise, data-draw, data-pop.
  Everything starts visible, so without JavaScript or anime.js the content is simply there.*/
(() => {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (typeof anime === 'undefined' || !('IntersectionObserver' in window) || prefersReducedMotion) return;

    const appearInstantly = { value: [0, 1], duration: 1, easing: 'linear' };
    const presets = {
        /*Blocks fade in and rise; the CSS translate property keeps the hover transform on cards free*/
        rise: {
            opacity: [0, 1],
            translate: ['0px 32px', '0px 0px'],
            duration: 900,
            easing: 'easeOutExpo',
            delay: anime.stagger(90)
        },
        /*Rules draw themselves from the left (needs transform-origin: left)*/
        draw: {
            opacity: appearInstantly,
            scaleX: [0, 1],
            duration: 900,
            easing: 'easeInOutQuart'
        },
        /*Small marks pop in one after another with a slight overshoot*/
        pop: {
            opacity: appearInstantly,
            scale: [0, 1],
            duration: 500,
            easing: 'easeOutBack',
            delay: anime.stagger(30)
        }
    };

    const selectorsByPreset = document.currentScript.dataset;

    for (const [presetName, animation] of Object.entries(presets)) {
        const selector = selectorsByPreset[presetName];
        if (!selector) continue;

        const elements = document.querySelectorAll(selector);
        anime.set(elements, { opacity: 0 });

        /*Elements entering in the same frame are animated as one staggered group*/
        const observer = new IntersectionObserver(entries => {
            const enteredElements = entries.filter(entry => entry.isIntersecting).map(entry => entry.target);
            if (enteredElements.length === 0) return;
            enteredElements.forEach(element => observer.unobserve(element));
            anime({ targets: enteredElements, ...animation });
        }, { rootMargin: '0px 0px -8% 0px' });

        elements.forEach(element => observer.observe(element));
    }
})();
