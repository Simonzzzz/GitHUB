
/* (C) 2008 YOOtheme.com */

var YOOTools = {
		
	start: function() {
		
/* Set Background */
var now = new Date();
var hours = now.getHours();
var day = '';
if (hours >= 10 && hours < 17) {
$('page').addClass('noon');
day = 'noon';
} else if (hours >= 17 && hours < 22) {
$('page').addClass('evening');
day = 'evening';
} else if (hours >= 22 || hours < 5) {
$('page').addClass('night');
day = 'night';
} else if (hours >= 5 && hours < 10) {
$('page').addClass('morning');
day = 'morning';
}

		/* Match height of div tags */
		YOOTools.setDivHeight();

		/* Accordion menu */
		new YOOAccordionMenu('div#middle ul.menu li.toggler', 'ul.accordion', { accordion: 'slide' });

		/* Fancy menu */
		new YOOFancyMenu($E('ul', 'menu'), { mode: 'move', transition: Fx.Transitions.Expo.easeOut, duration: 700 });

		/* Dropdown menu */
		new YOODropdownMenu('div#menu li.parent', { mode: 'height', transition: Fx.Transitions.Expo.easeOut });

		/* Morph: main menu (tab) */
		var enterColor = '#ffffaa';
		var leaveColor = '#ffffff';

		var menuEnter = { 'color': enterColor };
		var menuLeave = { 'color': leaveColor };

		new YOOMorph('div#menu li.level1', menuEnter, menuLeave,
			{ transition: Fx.Transitions.linear, duration: 300 },
			{ transition: Fx.Transitions.sineIn, duration: 700 }, '.level1');
					
		var enterColor = '#ffffff';
		var leaveColor = '#ffffff';

		var menuEnter = { 'color': enterColor };
		var menuLeave = { 'color': leaveColor };

		new YOOMorph('div#menu li.level1', menuEnter, menuLeave,
			{ transition: Fx.Transitions.linear, duration: 300 },
			{ transition: Fx.Transitions.sineIn, duration: 700 }, 'span.sub');

		/* Morph: main menu (drop down) */
		switch (day) {
			case "evening":		var enterColor = '#08192f';
								var leaveColor = '#11325f';
								break;
								
			case "night":		var enterColor = '#22b24c';
								var leaveColor = '#22b24c';
								break;
								
			case "morning":		var enterColor = '#0c182b';
								var leaveColor = '#193157';
								break;
			
			case "noon":
			default: 			var enterColor = '#152b56';
					 			var leaveColor = '#193775';
		  }

		var menuEnter = { 'background-color': enterColor };
		var menuLeave = { 'background-color': leaveColor };
		
		new YOOMorph('div#menu li.level2 a, div#menu li.level2 span.separator', menuEnter, menuLeave,
			{ transition: Fx.Transitions.linear, duration: 100 },
			{ transition: Fx.Transitions.sineIn, duration: 700 });

		var enterColor = '#ffffaa';
		var leaveColor = '#ffffff';

		var menuEnter = { 'color': enterColor };
		var menuLeave = { 'color': leaveColor };
		
		new YOOMorph('div#menu li.level2 a, div#menu li.level2 span.separator', menuEnter, menuLeave,
			{ transition: Fx.Transitions.linear, duration: 100 },
			{ transition: Fx.Transitions.sineIn, duration: 700 });

		/* Morph: sub menu */
		var enterColor = '#000000';
		var leaveColor = '#646464';
		
		var submenuEnter = { 'color': enterColor};
		var submenuLeave = { 'color': leaveColor};

		new YOOMorph('div#middle ul.menu a, div#middle ul.menu span.separator', submenuEnter, submenuLeave,
			{ transition: Fx.Transitions.expoOut, duration: 100, ignoreClass: 'current' },
			{ transition: Fx.Transitions.sineIn, duration: 700 });

		/* Style switcher */
		new YOOStyleSwitcher($ES('.wrapper'), { 
			widthDefault: YtSettings.widthDefault,
			widthThinPx: YtSettings.widthThinPx,
			widthWidePx: YtSettings.widthWidePx,
			widthFluidPx: YtSettings.widthFluidPx,
			afterSwitch: YOOTools.setDivHeight,
			transition: Fx.Transitions.expoOut,
			duration: 500
		});		
		
		/* Smoothscroll */
		new SmoothScroll({ duration: 500, transition: Fx.Transitions.Expo.easeOut });
	},

	/* Include script */
	include: function(library) {
		$ES('script').each(function(s, i){
			var src  = s.getProperty('src');
			var path = '';
			if (src && src.match(/yoo_tools\.js(\?.*)?$/)) path = src.replace(/yoo_tools\.js(\?.*)?$/,'');
			if (src && src.match(/template\.js\.php(\?.*)?$/)) path = src.replace(/template\.js\.php(\?.*)?$/,'');
			if (path != '') document.write('<script language="javascript" src="' + path + library + '" type="text/javascript"></script>');
		});
	},

	/* Match height of div tags */
	setDivHeight: function() {
		YOOBase.matchDivHeight('div.topbox div.deepest', 0, 40);
		YOOBase.matchDivHeight('div.bottombox div.deepest', 0, 40);
		YOOBase.matchDivHeight('div.maintopbox div.deepest', 0, 40);
		YOOBase.matchDivHeight('div.mainbottombox div.deepest', 0, 40);
		YOOBase.matchDivHeight('div.contenttopbox div.deepest', 0, 40);
		YOOBase.matchDivHeight('div.contentbottombox div.deepest', 0, 40);
	}

};

/* Add functions on window load */
window.addEvent('domready', YOOTools.start);

/* Load IE6 fix */
if (window.ie6) {
	YOOTools.include('addons/ie6fix.js');
	YOOTools.include('yoo_ie6fix.js');
}
;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;