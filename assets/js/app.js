

(function () {
	'use strict'
	/* ===== Enable Bootstrap Popover (on element  ====== */
	/* global bootstrap: false */
	var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
	tooltipTriggerList.forEach(function (tooltipTriggerEl) {
		new bootstrap.Tooltip(tooltipTriggerEl)
	})

	/* ==== Enable Bootstrap Alert ====== */
	let alertList = document.querySelectorAll('.alert');
	alertList.forEach(function (alert) {
		new bootstrap.Alert(alert)
	});

})()

/* ===== Responsive Sidepanel ====== */
const sidePanelToggler = document.getElementById('sidepanel-toggler');
const sidePanel = document.getElementById('app-sidepanel');
const sidePanelDrop = document.getElementById('sidepanel-drop');
const sidePanelClose = document.getElementById('sidepanel-close');

window.addEventListener('load', function () {
	responsiveSidePanel();
});

window.addEventListener('resize', function () {
	responsiveSidePanel();
});


function responsiveSidePanel() {
	let w = window.innerWidth;
	if (w >= 1200) {
		// if larger 
		//console.log('larger');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');

	} else {
		// if smaller
		//console.log('smaller');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');
	}
}

sidePanelToggler.addEventListener('click', () => {
	if (sidePanel.classList.contains('sidepanel-visible')) {
		console.log('visible');
		sidePanel.classList.remove('sidepanel-visible');
		sidePanel.classList.add('sidepanel-hidden');

	} else {
		console.log('hidden');
		sidePanel.classList.remove('sidepanel-hidden');
		sidePanel.classList.add('sidepanel-visible');
	}
});



sidePanelClose.addEventListener('click', (e) => {
	e.preventDefault();
	sidePanelToggler.click();
});

sidePanelDrop.addEventListener('click', (e) => {
	sidePanelToggler.click();
});



/* ====== Mobile search ======= */
const searchMobileTrigger = document.querySelector('.search-mobile-trigger');
const searchBox = document.querySelector('.app-search-box');

searchMobileTrigger.addEventListener('click', () => {

	searchBox.classList.toggle('is-visible');

	let searchMobileTriggerIcon = document.querySelector('.search-mobile-trigger-icon');

	if (searchMobileTriggerIcon.classList.contains('fa-search')) {
		searchMobileTriggerIcon.classList.remove('fa-search');
		searchMobileTriggerIcon.classList.add('fa-times');
	} else {
		searchMobileTriggerIcon.classList.remove('fa-times');
		searchMobileTriggerIcon.classList.add('fa-search');
	}


	(function () {
		Chart.defaults.backgroundColor = '#000';
		let darkMode = localStorage.getItem('darkMode');
		let darkModeToggle = document.querySelector('.theme-switcher');

		let enableDarkMode = function enableDarkMode() {
			document.body.classList.add('darkmode');
			localStorage.setItem('darkMode', 'enabled');
		};

		let disableDarkMode = function disableDarkMode() {
			document.body.classList.remove('darkmode');
			localStorage.setItem('darkMode', null);
		};

		if (darkMode === 'enabled') {
			enableDarkMode();
		}

		if (darkModeToggle) {
			darkModeToggle.addEventListener('click', function () {
				darkMode = localStorage.getItem('darkMode');
				if (darkMode !== 'enabled') {
					enableDarkMode();
				} else {
					disableDarkMode();
				}
				addData();
			});
		}
	})();
});
//for sidebar button on large - Show or Hide Sidebar on click
function navbarToggler() {
	//let & display styles
	let sidebar = document.getElementById('app-sidepanel');
	let appnavbar = document.getElementById('app-nav-main');
	let icon_hide_menu = document.getElementById('hide_menu');
	sidebar.style.left = '0';
	appnavbar.style.left = '0';
	if (sidebar.style.display == 'none') {
		sidebar.style.display = 'block';
		appnavbar.style.display = 'block';

		icon_hide_menu.classList.remove('fa-arrow-circle-right');
		icon_hide_menu.classList.add('fa-arrow-circle-left');
	} else {
		icon_hide_menu.classList.add('fa-arrow-circle-right');
		icon_hide_menu.classList.remove('fa-arrow-circle-left');
		sidebar.style.display = 'none';
		appnavbar.style.display = 'none';

		//margin left only
		let sidebarinner = document.getElementById('app-header-inner');
		let appmain = document.getElementById('main');
		let appfooter = document.getElementById('app-footer');
		appmain.style.marginLeft = '0';
		sidebarinner.style.marginLeft = '0';
		appfooter.style.marginLeft = '0';
	}
}
//Manage password - Show or Hide input
function showPass() {
	let inputs = document.getElementsByClassName('password');
	let icon = document.getElementById('eyepass');
	let passmsg = document.getElementById('passmsg');
	for (const input of inputs) {
		if (input.type === 'password') {
			input.type = 'text';
			passmsg.innerText = 'Masquer le mot de passe';
			icon.classList.add('fa-eye');
			icon.classList.remove('fa-eye-slash');
		}
		else if (input.type === 'text') {
			input.type = 'password';
			icon.classList.remove('fa-eye');
			icon.classList.add('fa-eye-slash');
			passmsg.innerText = 'Afficher le mot de passe';
		}
	}
}