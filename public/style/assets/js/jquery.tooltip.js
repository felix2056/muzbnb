/**
 * Perfect Tooltip, v1.6
 *
 * @author	Tomasz Borychowski
 * @url http://tborychowski.github.com/perfecttooltip
 *
 * Usage:
 *   $('selector').tooltip();
 *   $('selector').tooltip('text');
 *   $('selector').tooltip({ text: 'text', position: 'br' });
 *   $('selector').tooltip('_destroy');								// to remove the tooltip
 *
 * Creates a tooltip instance: $('selector').tooltip(conf)
 *
 * @param conf {Object}				tooltip config object:
 *		text {String}					tooltip text (can be html)
 *		position {String}				tooltip position in relation to the target (selector) it can be 1 of the following:
 *										- 'auto' or 'default' (or not set) to auto calculate the position
 *										- tl, t, tr, bl, b, br, lt, l, lb, rt, r, rb - to force a particular position
 *										if tooltip goes out of the screen - the position will be auto-updated to show it
 *										in a viewport (to enforce the position use "forcePosition" instead)
 *		forcePosition {Boolean}			true to enforce the position even if tooltip goes out of the screen
 *		animate {Bool|Int}				animate fadeIn/Out, defaults to false (IE always false), it can be also an anim speed
 *										in milisec
 *		trigger {String}				show tooltip event listener [hover|click|manual], defaults to 'hover'
 *		showDelay {int}					delay showing the tooltip for x miliseconds, defaults to 100
 *		dontHideOnTooltipHover {Bool}	don't hide the tooltip when mouse is over it
 *		cls {String}				    additional css class for the tooltip
 *		selector {String}				if not empty - tooltip will be attached to the target but event will be filtered
 *                                      by this selector
 *
 * @returns								a tooltip instance
 */

(function ($) {
	'use strict';

	var

	defaults = {
		text: '',
		cls: '',
		position: 'default',
		forcePosition: false,
		animate: false,
		trigger: 'hover',
		showDelay: 200,
		dontHideOnTooltipHover: false,
		selector: ''
	},
	eventNS = '.tooltip',

	_getHtml = function (id, text, cls) {
		return '<div id="' + id + '" class="' + (cls || '') + '" ' +
			'style="display:none; position:absolute; -webkit-transform:translateZ(0) translate3d(0, 0, 0); ' +
			'transform:translateZ(0) translate3d(0, 0, 0);">' + text + '</div>';
	},

	Tooltip = function (target, conf) {
		var config = {},
			self = this,
			timestamp = +new Date(),
			tooltipId = 'tooltip' + timestamp,
			showEvent = 'mouseenter',
			isIE = navigator.userAgent.match(/msie/i);


		// if just text given - make it a text
		if (typeof conf === 'string') conf = { text: conf };


		// if not number - remove and use default
		if (conf && typeof conf.showDelay !== 'number') delete conf.showDelay;

		config = $.extend({}, defaults, conf || {}, config);

		// already has a tooltip
		if (target.length && target.data('tooltipId')) return target;

		// cache references to frequently used objects
		this.conf = config;
		this.target = target;
		this.win = $(window);
		this.doc = $(document);
		this.animSpeed = 100;
		this.targetDistance = 7;
		this.screenMargin = 20;
		this.tooltipId = tooltipId;

		// don't animate in IE, else show as in conf
		if (isIE || this.conf.animate === false) this.animSpeed = 0;

		if (typeof this.conf.trigger === 'string') {
			showEvent = (this.conf.trigger === 'hover' ? 'mouseenter' : this.conf.trigger);
		}

		// tooltip from config
		if (this.conf.text) this.text = this.conf.text;

		// tooltip from data-title or title or nothing
		else if (!this.conf.selector) {
			this.text = this.target.data('title') || this.target.attr('title') || '';
			this.target.removeAttr('title').data('title', this.text);
		}

		// destroy previous tooltip if any
		this.destroy();


		/* EVENTS */

		this.target.data('tooltipId', tooltipId).off(eventNS);
		if (this.conf.selector) {
			this.target
				.on(showEvent + eventNS, this.conf.selector, function (e) { self.show.call(self, e, this); })
				.on('mouseleave' + eventNS, this.conf.selector, function (e) { self.hide.call(self, e, this); })
				.on('destroyed' + eventNS, this.conf.selector, function () { self.destroy.call(self); });
		}
		else {
			this.target
				.on(showEvent + eventNS, function (e) { self.show.call(self, e, this); })
				.on('mouseleave' + eventNS, function (e) { self.hide.call(self, e, this); })
				.on('destroyed' + eventNS, function () { self.destroy.call(self); });
		}

		if (isIE) this.target.on('mousemove' + eventNS, this.conf.selector, function (e) { self.show.call(self, e, this); });

		if (this.tooltip && this.conf.dontHideOnTooltipHover === true) {
			this.tooltip.off(eventNS)
				.on('mouseenter' + eventNS, function (e) { self.dontHide.call(self, e, this); })
				.on('mouseleave' + eventNS, function (e) { self.hide.call(self, e, this); });
		}

		return this;
	};


	Tooltip.prototype.show = function (ev, el) {
		var self = this;
		this.currentTarget = $(el);
		if (!this.tooltip) {
			this.text = this.currentTarget.data('title') || this.currentTarget.attr('title') || this.conf.text || '';
			this.currentTarget.removeAttr('title').data('title', this.text);

			if (!this.text) return;

			this.tooltip = $(_getHtml(this.tooltipId, this.text, this.conf.cls)).appendTo('body');
			this.tooltip.data('tooltip', this);

			if (this.tooltip && this.conf.dontHideOnTooltipHover === true) {
				this.tooltip.off(eventNS)
					.on('mouseenter' + eventNS, function (e) { self.dontHide.call(self, e, this); })
					.on('mouseleave' + eventNS, function (e) { self.hide.call(self, e, this); });
			}
		}
		if (!this.tooltip || !this.tooltip.length) return;

		if (this.tooltip.is(':hidden')) {
			this.tooltip.stop(true).fadeTo(0, 0).show();
			setTimeout(function () { self.align.call(self, self.currentTarget); }, 10);
			this.align(this.currentTarget).delay(this.conf.showDelay).fadeTo(this.animSpeed, 1);
		}
		else this.align(this.currentTarget).stop(true).fadeTo(this.animSpeed, 1);
	};


	Tooltip.prototype.hide = function () {
		var self = this, animSpeed = (this.conf.dontHideOnTooltipHover ? this.animSpeed + 100 : this.animSpeed);
		if (!this.tooltip) return;
		this.tooltip.stop(true).fadeTo(animSpeed, 0, function () {
			self.tooltip.remove();
			self.tooltip = null;
		});
	};

	Tooltip.prototype.dontHide = function () { this.tooltip.stop(true).fadeTo(0, 1); };


	Tooltip.prototype.align = function (el, keepOnScreen) {
		/*jshint white:false */ // - allow for a normal switch-case alignment

		if (!this || !this.tooltip) return;
		if (!el || !el.length || el.is(':hidden')) return this.tooltip.hide();

		var position = this.conf.position,
			targetOff = el.offset(),
			targetW = el.outerWidth(),
			targetH = el.outerHeight(),
			win = {
				width: this.win.width(),
				height: this.win.height(),
				scrollLeft: this.doc.scrollLeft(),
				scrollTop: this.doc.scrollTop()
			},
			target = {
				l: targetOff.left,
				t: targetOff.top,
				r: targetOff.left + targetW,
				b: targetOff.top + targetH,
				w: targetW,
				h: targetH
			},
			tooltip = {
				w: this.tooltip.outerWidth(),
				h: this.tooltip.outerHeight()
			}, cls, isOnScreen;

		// center tooltip on target
		tooltip.left = target.l + (target.w - tooltip.w) / 2;
		tooltip.top = target.t + (target.h - tooltip.h) / 2;

		// default - auto calculate
		if (position === 'default' || position === 'auto' || keepOnScreen === true) {

			// assuming normal position - above target
			tooltip.left = target.l + (target.w - tooltip.w) / 2;
			tooltip.top = target.t - tooltip.h - this.targetDistance;
			position = '';

			// too far to the top - put tooltip below element
			if (win.scrollTop > tooltip.top) {
				tooltip.top = target.t + target.h + this.targetDistance;
				position += 'b';
			}
			else position += 't';

			// too far to the left - put tooltip to the right of the target
			if (tooltip.left < this.screenMargin + win.scrollLeft) {
				tooltip.left = this.screenMargin + win.scrollLeft;
				position += 'r';
			}

			// too far to the right - put tooltip to the left of the target
			if (tooltip.left + tooltip.w + this.screenMargin - win.scrollLeft > win.width) {
				tooltip.left = win.width - tooltip.w - this.screenMargin + win.scrollLeft;
				position += 'l';
				if (tooltip.left < target.l - tooltip.w) {
					// keep tooltip on target
					tooltip.left = target.l  - tooltip.w;
				}
			}
		}

		// position the tooltip
		cls = ['tooltip', (this.conf.cls || ''), 'tooltip-' + position[0]];
		switch (position[0]) {
		case 't' :
			tooltip.top	= target.t - tooltip.h - this.targetDistance;
			break;
		case 'b' :
			tooltip.top	= target.b + this.targetDistance;
			break;
		case 'l' :
			tooltip.left	= target.l - tooltip.w - this.targetDistance;
			break;
		case 'r' :
			tooltip.left	= target.r + this.targetDistance;
			break;
		}
		if (position[1]) {
			cls.push('tooltip-' + position[0] + position[1]);
			switch (position[1]) {
			case 't' :
				tooltip.top	= target.b - tooltip.h - target.h / 2 + 10;
				break;
			case 'b' :
				tooltip.top	= target.t + target.h / 2 - 10;
				break;
			case 'r' :
				tooltip.left	= target.l + target.w / 2 - 10;
				break;
			case 'l' :
				tooltip.left	= target.r - tooltip.w - target.w / 2 + 10;
				break;
			}
		}

		this.tooltip.attr('class', cls.join(' ')).css(tooltip);

		// if forcePosition != true -> check if on screen and realign if necessary
		if (this.conf.forcePosition !== true && keepOnScreen !== true) {
			isOnScreen = true;

			// above screen
			if (tooltip.top + this.screenMargin < win.scrollTop) isOnScreen = false;

			// below screen
			if (tooltip.top + tooltip.h + this.screenMargin - win.scrollTop > win.height) isOnScreen = false;

			// too far to the left
			if (tooltip.left < this.screenMargin + win.scrollLeft) isOnScreen = false;

			// too far to the right
			if (tooltip.left + tooltip.w + this.screenMargin - win.scrollLeft > win.width) isOnScreen = false;
			if (isOnScreen === false) return this.align(el, true);
		}

		return this.tooltip;
	};


	Tooltip.prototype.destroy = function () {
		if (this.target && this.target.length) this.target.off('.tooltip').removeData('tooltipId');
		if (this.tooltip && this.tooltip.length) this.tooltip.remove();
	};


	$.fn.tooltip = function (options) {
		var target, tt, td, id;
		return $(this).each(function () {
			target = $(this);
			if (target.length) id = target.data('tooltipId');
			if (id) tt = $('#' + id);

			if (options === '_destroy') {
				if (tt && tt.length) tt.remove();								// remove tooltips
				target.off('.tooltip').removeData('tooltipId');					// remove event listeners from targets
				return;
			}
			else if (options === 'hide') {
				if (tt && tt.length) {
					td = tt.data('tooltip');
					if (td && td.hide) td.hide();
				}
				return;
			}

			tt = new Tooltip(target, options);
		});
	};
})(jQuery);




/**
 * Provides a destroyed event on an element.
 * <p>
 * The destroyed event is called when the element is removed as a result of jQuery DOM manipulators like remove, html,
 * replaceWith, etc. Destroyed events do not bubble, so make sure you don't use live or delegate with destroyed events.
 * </p>
 * <h2>Example</h2>
 * @codestart
 * $(".foo").bind("destroyed", function () { clean up code });
 * @codeend
 */
(function ($) {
	var oldClean = jQuery.cleanData;
	$.cleanData = function (elems) {
		for (var i = 0, elem; elem = elems[i++] ;)
			$(elem).triggerHandler('destroyed');
		oldClean(elems);
	};
})(jQuery);