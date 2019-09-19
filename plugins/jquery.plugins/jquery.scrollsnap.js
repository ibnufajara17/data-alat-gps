//Scrollstart/scrollstop Event Plugin
//Author: James Padolsey
//http://james.padolsey.com/javascript/special-scroll-events-for-jquery/
(function($){
    var special = $.event.special,
        uid1 = 'D' + (+new Date()),
        uid2 = 'D' + (+new Date() + 1);
 
    special.scrollstart = {
        setup: function() {
 
            var timer,
                handler =  function(evt) {
 
                    var _self = this,
                        _args = arguments;
 
                    if (timer) {
                        clearTimeout(timer);
                    } else {
                        evt.type = 'scrollstart';
                        $.event.dispatch.apply(_self, _args);
                    }
 
                    timer = setTimeout( function(){
                        timer = null;
                    }, special.scrollstop.latency);
 
                };
 
            $(this).bind('scroll', handler).data(uid1, handler);
 
        },
        teardown: function(){
            $(this).unbind( 'scroll', $(this).data(uid1) );
        }
    };
 
    special.scrollstop = {
        latency: 300,
        setup: function() {
            var timer,
                handler = function(evt) {
                    var _self = this,
                        _args = arguments;
 
                    if (timer) {
                        clearTimeout(timer);
                    }
 
                    timer = setTimeout( function(){
                        timer = null;
                        evt.type = 'scrollstop';
                        $.event.dispatch.apply(_self, _args);
 
                    }, special.scrollstop.latency);
                };
 
            $(this).bind('scroll', handler).data(uid2, handler);
 
        },
        teardown: function() {
            $(this).unbind('scroll', $(this).data(uid2));
        }
    };
 
})(jQuery);

(function( $ ) {

    /**
     * Underscore.js 1.5.2
     * http://underscorejs.org
     * (c) 2009-2013 Jeremy Ashkenas, DocumentCloud and Investigative Reporters & Editors
     * Underscore may be freely distributed under the MIT license.
     */
    function debounce (func, wait, immediate) {
        var timeout, args, context, timestamp, result;
        return function() {
            context = this;
            args = arguments;
            timestamp = new Date();
            var later = function() {
                var last = (new Date()) - timestamp;
                if (last < wait) {
                    timeout = setTimeout(later, wait - last);
                } else {
                    timeout = null;
                    if (!immediate) result = func.apply(context, args);
                }
            };
            var callNow = immediate && !timeout;
            if (!timeout) {
                timeout = setTimeout(later, wait);
            }
            if (callNow) result = func.apply(context, args);
            return result;
        };
    }

    $.fn.scrollsnap = function( options ) {

        var settings = $.extend( {
            'direction': 'y',
            'snaps' : '*',
            'proximity' : 12,
            'offset' : 0,
            'duration' : 200,
            'latency' : 250,
            'easing' : 'swing',
            'onSnapEvent' : 'scrollsnap', // triggered on the snapped DOM element
            'onSnap' : function ($snappedElement) { }, // callback when an element was snapped
            'onSnapWait' : 50 // wait for redundant snaps before firing event / calling callback
        }, options);

        var leftOrTop = settings.direction === 'x' ? 'Left' : 'Top';

        return this.each(function() {

            var scrollingEl = this,
                $scrollingEl = $(scrollingEl);

            if (scrollingEl['scroll'+leftOrTop] !== undefined) {
                // scrollingEl is DOM element (not document)
                $scrollingEl.css('position', 'relative');

                $scrollingEl.bind('scrollstop', {latency: settings.latency}, function(e) {

                    var matchingEl = null, matchingDy = settings.proximity + 1;

                    $scrollingEl.find(settings.snaps).each(function() {
                        var snappingEl = this,
                            dy = Math.abs(snappingEl['offset'+leftOrTop] + settings.offset - scrollingEl['scroll'+leftOrTop]);

                        if (dy <= settings.proximity && dy < matchingDy) {
                            matchingEl = snappingEl;
                            matchingDy = dy;
                        }
                    });

                    if (matchingEl) {
                        var endScroll = matchingEl['offset'+leftOrTop] + settings.offset,
                            animateProp = {};
                        animateProp['scroll'+leftOrTop] = endScroll;
                        if ($scrollingEl['scroll'+leftOrTop]() != endScroll) {
                            $scrollingEl.animate(animateProp, settings.duration, settings.easing, debounce(function () {
                                var $matchingEl = $(matchingEl);

                                if (settings.onSnap) {
                                    settings.onSnap($matchingEl);
                                }

                                $matchingEl.trigger(settings.onSnapEvent);

                            }, settings.onSnapWait));
                        }
                    }

                });

            } else if (scrollingEl.defaultView) {
                // scrollingEl is DOM document
                var handler = function(e) {

                    var matchingEl = null, matchingDy = settings.proximity + 1;

                    $scrollingEl.find(settings.snaps).each(function() {
                        var snappingEl = this,
                            $snappingEl = $(snappingEl),
                            dy = Math.abs(($snappingEl.offset()[leftOrTop.toLowerCase()] + settings.offset) - scrollingEl.defaultView['scroll'+settings.direction.toUpperCase()]);

                        if (dy <= settings.proximity && dy < matchingDy) {
                            matchingEl = snappingEl;
                            matchingDy = dy;
                        }
                    });

                    if (matchingEl) {
                        var $matchingEl = $(matchingEl),
                            endScroll = $matchingEl.offset()[leftOrTop.toLowerCase()] + settings.offset,
                            animateProp = {};
                        animateProp['scroll'+leftOrTop] = endScroll;
                        if ($scrollingEl['scroll'+leftOrTop]() != endScroll) {
                            $('html, body').animate(animateProp, settings.duration, settings.easing, debounce(function () {
                                if (settings.onSnap) {
                                    settings.onSnap($matchingEl);
                                }

                                $matchingEl.trigger(settings.onSnapEvent)
                            }, settings.onSnapWait));
                        }
                    }
                };
                $scrollingEl.bind('scrollstop', {latency: settings.latency}, handler);
                $(window).bind('resize', {latency: settings.latency}, handler);
            }
        });
    };

})( jQuery );
