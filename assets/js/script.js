const App = (() => {
	'use strict';

	// Private variables
	let scrollState = { top: 0, left: 0 };
	const splideInstances = new Map();

	const defaultSplideOptions = {
		pauseOnHover: false,
		pauseOnFocus: false,
		type: 'loop',
		speed: 300,
		perPage: 1,
		gap: 0,
		autoplay: false,
		arrows: false,
		pagination: false,
	};

	// Private methods
	const bindEvents = () => {
		$(document)
			.on('click', '.tab a', handleTabClick)
			.on('click', '.anchor-link', handleAnchorLink)
			.on('click', '.page-top a', scrollToTop);
	};

	const handleTabClick = function (e) {
		e.preventDefault();

		const $this = $(this);
		const target = $this.attr('href').split('#')[1];

		if (!target) return;

		// Update active states
		$this.parent().addClass('active').siblings().removeClass('active');

		// Show/hide content
		const $targetContent = $(`[data-id="${target}"]`);
		$targetContent.fadeIn(0).siblings().fadeOut(0);
	};

	const handleAnchorLink = function (e) {
		const isSamePage = location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '')
			&& location.hostname === this.hostname;

		if (!isSamePage) return;

		const target = findTarget(this.hash);
		if (target.length) {
			e.preventDefault();
			smoothScrollTo(target.offset().top);
		}
	};

	const scrollToTop = (e) => {
		e.preventDefault();
		smoothScrollTo(0);
	};

	const findTarget = (hash) => {
		const $target = $(hash);
		return $target.length ? $target : $(`[name="${hash.slice(1)}"]`);
	};

	const smoothScrollTo = (position, duration = 500) => {
		$('html, body').animate({ scrollTop: position }, duration);
	};

	const initializeTabs = () => {
		const hash = location.hash;
		const $hashTab = $(`.tab li a[href="${hash}"]`);

		if (hash && $hashTab.length) {
			$hashTab.trigger('click');
		} else {
			$('.tab li:first-child a').trigger('click');
		}
	};

	const initSplide = (selector, options = {}) => {
		const sliders = document.querySelectorAll(selector);

		if (!sliders.length) {
			return false;
		}

		sliders.forEach((sliderElement) => {
			const splideOptions = Object.assign({}, defaultSplideOptions, options);

			// arrows
			const navNext = sliderElement.querySelector('.splide__arrow--next');
			const navPrev = sliderElement.querySelector('.splide__arrow--prev');
			if (navNext || navPrev) {
				splideOptions.arrows = true;
			}

			// pagination
			const pagination = sliderElement.querySelector('.splide__pagination');
			if (pagination) {
				splideOptions.pagination = true;
			}

			const splide = new Splide(sliderElement, splideOptions).mount();
			splideInstances.set(sliderElement, splide);
		});

		return true;
	};

	const destroySplide = (selector) => {
		const sliders = selector ? document.querySelectorAll(selector) : splideInstances.keys();

		for (const sliderElement of sliders) {
			const splide = splideInstances.get(sliderElement);
			if (splide) {
				splide.destroy();
				splideInstances.delete(sliderElement);
			}
		}
	};

	const getSplideInstance = (selector) => {
		const sliderElement = document.querySelector(selector);
		return splideInstances.get(sliderElement);
	};

	// Public API
	return {
		init() {
			bindEvents();
			initializeTabs();
		},
		
		initSplide,
		destroySplide,
		getSplideInstance,

		stopScroll() {
			scrollState.top = $(window).scrollTop();
			scrollState.left = $(window).scrollLeft();

			$('html')
				.addClass('noscroll')
				.css('top', `-${scrollState.top}px`);
		},

		resumeScroll() {
			$('html').removeClass('noscroll').css('top', '');
			$(window).scrollTop(scrollState.top).scrollLeft(scrollState.left);
		},

		scrollTo: smoothScrollTo,

		activateTab(target) {
			$(`.tab li a[href="#${target}"]`).trigger('click');
		}
	};
})();

document.addEventListener('DOMContentLoaded', function() {
	App.init();
});