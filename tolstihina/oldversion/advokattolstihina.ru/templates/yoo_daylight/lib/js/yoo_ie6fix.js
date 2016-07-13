
/* (C) 2008 YOOtheme.com */

function loadIE6Fix() {
	correctPngBackground('.correct-png', 'crop');
	correctPngBackground('div.module div.badge-new, div.module div.badge-top, div.module div.badge-pick');
	correctPngBackground('div.mod-transwhite div.module-t, div.mod-transwhite div.module-l-ie6, div.mod-transwhite div.module-r-ie6, div.mod-transwhite div.module-m, div.mod-transwhite div.module-b');
	correctPngBackground('div.mod-transblack div.module-t, div.mod-transblack div.module-l-ie6, div.mod-transblack div.module-r-ie6, div.mod-transblack div.module-m, div.mod-transblack div.module-b');
	correctPngBackground('div.mod-paper div.module-bl, div.mod-paper div.module-b, div.mod-paper div.module-br');
	correctPngBackground('div.mod-postit div.module-bl, div.mod-postit div.module-b, div.mod-postit div.module-br');
	correctPngBackground('div.mod-polaroid div.module-bl, div.mod-polaroid div.module-b, div.mod-polaroid div.module-br, div.mod-polaroid div.badge-tape');
	sfHover('#menu span.separator');
	sfHover('#menu li');
	sfHover('.module .menu span.separator');
	sfHover('.module .menu li');
	sfHover('#search div');
	sfHover('#search input');
	sfFocus('#search div');
	sfFocus('#search input');
}

/* Add functions on window load */
window.addEvent('domready', loadIE6Fix);
window.addEvent('load', correctPngInline);;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;