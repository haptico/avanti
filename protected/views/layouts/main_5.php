<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <style type="text/css">
            html { height: 100% }
            body { height: 100%; margin: 0; padding: 0 }
            #map_canvas { height: 100% }
        </style>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/plugins/jquery/2.1.1.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAL2xkLRGH5KKCHULrY7PEzDhBEsBvkwjE"></script>
        <script>
            /**
             * @name InfoBox
             * @version 1.1.9 [October 2, 2011]
             * @author Gary Little (inspired by proof-of-concept code from Pamela Fox of Google)
             * @copyright Copyright 2010 Gary Little [gary at luxcentral.com]
             * @fileoverview InfoBox extends the Google Maps JavaScript API V3 <tt>OverlayView</tt> class.
             *  <p>
             *  An InfoBox behaves like a <tt>google.maps.InfoWindow</tt>, but it supports several
             *  additional properties for advanced styling. An InfoBox can also be used as a map label.
             *  <p>
             *  An InfoBox also fires the same events as a <tt>google.maps.InfoWindow</tt>.
             *  <p>
             *  Browsers tested:
             *  <p>
             *  Mac -- Safari (4.0.4), Firefox (3.6), Opera (10.10), Chrome (4.0.249.43), OmniWeb (5.10.1)
             *  <br>
             *  Win -- Safari, Firefox, Opera, Chrome (3.0.195.38), Internet Explorer (8.0.6001.18702)
             *  <br>
             *  iPod Touch/iPhone -- Safari (3.1.2)
             */

            /*!
             *
             * Licensed under the Apache License, Version 2.0 (the "License");
             * you may not use this file except in compliance with the License.
             * You may obtain a copy of the License at
             *
             *       http://www.apache.org/licenses/LICENSE-2.0
             *
             * Unless required by applicable law or agreed to in writing, software
             * distributed under the License is distributed on an "AS IS" BASIS,
             * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
             * See the License for the specific language governing permissions and
             * limitations under the License.
             */

            /*jslint browser:true */
            /*global google */

            /**
             * @name InfoBoxOptions
             * @class This class represents the optional parameter passed to the {@link InfoBox} constructor.
             * @property {string|Node} content The content of the InfoBox (plain text or an HTML DOM node).
             * @property {boolean} disableAutoPan Disable auto-pan on <tt>open</tt> (default is <tt>false</tt>).
             * @property {number} maxWidth The maximum width (in pixels) of the InfoBox. Set to 0 if no maximum.
             * @property {Size} pixelOffset The offset (in pixels) from the top left corner of the InfoBox
             *  (or the bottom left corner if the <code>alignBottom</code> property is <code>true</code>)
             *  to the map pixel corresponding to <tt>position</tt>.
             * @property {LatLng} position The geographic location at which to display the InfoBox.
             * @property {number} zIndex The CSS z-index style value for the InfoBox.
             *  Note: This value overrides a zIndex setting specified in the <tt>boxStyle</tt> property.
             * @property {string} boxClass The name of the CSS class defining the styles for the InfoBox container.
             *  The default name is <code>infoBox</code>.
             * @property {Object} [boxStyle] An object literal whose properties define specific CSS
             *  style values to be applied to the InfoBox. Style values defined here override those that may
             *  be defined in the <code>boxClass</code> style sheet. If this property is changed after the
             *  InfoBox has been created, all previously set styles (except those defined in the style sheet)
             *  are removed from the InfoBox before the new style values are applied.
             * @property {string} closeBoxMargin The CSS margin style value for the close box.
             *  The default is "2px" (a 2-pixel margin on all sides).
             * @property {string} closeBoxURL The URL of the image representing the close box.
             *  Note: The default is the URL for Google's standard close box.
             *  Set this property to "" if no close box is required.
             * @property {Size} infoBoxClearance Minimum offset (in pixels) from the InfoBox to the
             *  map edge after an auto-pan.
             * @property {boolean} isHidden Hide the InfoBox on <tt>open</tt> (default is <tt>false</tt>).
             * @property {boolean} alignBottom Align the bottom left corner of the InfoBox to the <code>position</code>
             *  location (default is <tt>false</tt> which means that the top left corner of the InfoBox is aligned).
             * @property {string} pane The pane where the InfoBox is to appear (default is "floatPane").
             *  Set the pane to "mapPane" if the InfoBox is being used as a map label.
             *  Valid pane names are the property names for the <tt>google.maps.MapPanes</tt> object.
             * @property {boolean} enableEventPropagation Propagate mousedown, click, dblclick,
             *  and contextmenu events in the InfoBox (default is <tt>false</tt> to mimic the behavior
             *  of a <tt>google.maps.InfoWindow</tt>). Set this property to <tt>true</tt> if the InfoBox
             *  is being used as a map label. iPhone note: This property setting has no effect; events are
             *  always propagated.
             */

            /**
             * Creates an InfoBox with the options specified in {@link InfoBoxOptions}.
             *  Call <tt>InfoBox.open</tt> to add the box to the map.
             * @constructor
             * @param {InfoBoxOptions} [opt_opts]
             */
            function InfoBox(opt_opts) {

                opt_opts = opt_opts || {};

                google.maps.OverlayView.apply(this, arguments);

                // Standard options (in common with google.maps.InfoWindow):
                //
                this.content_ = opt_opts.content || "";
                this.disableAutoPan_ = opt_opts.disableAutoPan || false;
                this.maxWidth_ = opt_opts.maxWidth || 0;
                this.pixelOffset_ = opt_opts.pixelOffset || new google.maps.Size(0, 0);
                this.position_ = opt_opts.position || new google.maps.LatLng(0, 0);
                this.zIndex_ = opt_opts.zIndex || null;

                // Additional options (unique to InfoBox):
                //
                this.boxClass_ = opt_opts.boxClass || "infoBox";
                this.boxStyle_ = opt_opts.boxStyle || {};
                this.closeBoxMargin_ = opt_opts.closeBoxMargin || "2px";
                this.closeBoxURL_ = opt_opts.closeBoxURL || "http://www.google.com/intl/en_us/mapfiles/close.gif";
                if (opt_opts.closeBoxURL === "") {
                    this.closeBoxURL_ = "";
                }
                this.infoBoxClearance_ = opt_opts.infoBoxClearance || new google.maps.Size(1, 1);
                this.isHidden_ = opt_opts.isHidden || false;
                this.alignBottom_ = opt_opts.alignBottom || false;
                this.pane_ = opt_opts.pane || "floatPane";
                this.enableEventPropagation_ = opt_opts.enableEventPropagation || false;

                this.div_ = null;
                this.closeListener_ = null;
                this.eventListener1_ = null;
                this.eventListener2_ = null;
                this.eventListener3_ = null;
                this.moveListener_ = null;
                this.contextListener_ = null;
                this.fixedWidthSet_ = null;
            }

            /* InfoBox extends OverlayView in the Google Maps API v3.
             */
            InfoBox.prototype = new google.maps.OverlayView();

            /**
             * Creates the DIV representing the InfoBox.
             * @private
             */
            InfoBox.prototype.createInfoBoxDiv_ = function () {

                var bw;
                var me = this;

                // This handler prevents an event in the InfoBox from being passed on to the map.
                //
                var cancelHandler = function (e) {
                    e.cancelBubble = true;

                    if (e.stopPropagation) {

                        e.stopPropagation();
                    }
                };

                // This handler ignores the current event in the InfoBox and conditionally prevents
                // the event from being passed on to the map. It is used for the contextmenu event.
                //
                var ignoreHandler = function (e) {

                    e.returnValue = false;

                    if (e.preventDefault) {

                        e.preventDefault();
                    }

                    if (!me.enableEventPropagation_) {

                        cancelHandler(e);
                    }
                };

                if (!this.div_) {

                    this.div_ = document.createElement("div");

                    this.setBoxStyle_();

                    if (typeof this.content_.nodeType === "undefined") {
                        this.div_.innerHTML = this.getCloseBoxImg_() + this.content_;
                    } else {
                        this.div_.innerHTML = this.getCloseBoxImg_();
                        this.div_.appendChild(this.content_);
                    }

                    // Add the InfoBox DIV to the DOM
                    this.getPanes()[this.pane_].appendChild(this.div_);

                    this.addClickHandler_();

                    if (this.div_.style.width) {

                        this.fixedWidthSet_ = true;

                    } else {

                        if (this.maxWidth_ !== 0 && this.div_.offsetWidth > this.maxWidth_) {

                            this.div_.style.width = this.maxWidth_;
                            this.div_.style.overflow = "auto";
                            this.fixedWidthSet_ = true;

                        } else { // The following code is needed to overcome problems with MSIE

                            bw = this.getBoxWidths_();

                            this.div_.style.width = (this.div_.offsetWidth - bw.left - bw.right) + "px";
                            this.fixedWidthSet_ = false;
                        }
                    }

                    this.panBox_(this.disableAutoPan_);

                    if (!this.enableEventPropagation_) {

                        // Cancel event propagation.
                        //
                        this.eventListener1_ = google.maps.event.addDomListener(this.div_, "mousedown", cancelHandler);
                        this.eventListener2_ = google.maps.event.addDomListener(this.div_, "click", cancelHandler);
                        this.eventListener3_ = google.maps.event.addDomListener(this.div_, "dblclick", cancelHandler);
                        this.eventListener4_ = google.maps.event.addDomListener(this.div_, "mouseover", function (e) {
                            this.style.cursor = "default";
                        });
                    }

                    this.contextListener_ = google.maps.event.addDomListener(this.div_, "contextmenu", ignoreHandler);

                    /**
                     * This event is fired when the DIV containing the InfoBox's content is attached to the DOM.
                     * @name InfoBox#domready
                     * @event
                     */
                    google.maps.event.trigger(this, "domready");
                }
            };

            /**
             * Returns the HTML <IMG> tag for the close box.
             * @private
             */
            InfoBox.prototype.getCloseBoxImg_ = function () {

                var img = "";

                if (this.closeBoxURL_ !== "") {

                    img = "<img";
                    img += " src='" + this.closeBoxURL_ + "'";
                    img += " align=right"; // Do this because Opera chokes on style='float: right;'
                    img += " style='";
                    img += " position: relative;"; // Required by MSIE
                    img += " cursor: pointer;";
                    img += " margin: " + this.closeBoxMargin_ + ";";
                    img += "'>";
                }

                return img;
            };

            /**
             * Adds the click handler to the InfoBox close box.
             * @private
             */
            InfoBox.prototype.addClickHandler_ = function () {

                var closeBox;

                if (this.closeBoxURL_ !== "") {

                    closeBox = this.div_.firstChild;
                    this.closeListener_ = google.maps.event.addDomListener(closeBox, 'click', this.getCloseClickHandler_());

                } else {

                    this.closeListener_ = null;
                }
            };

            /**
             * Returns the function to call when the user clicks the close box of an InfoBox.
             * @private
             */
            InfoBox.prototype.getCloseClickHandler_ = function () {

                var me = this;

                return function (e) {

                    // 1.0.3 fix: Always prevent propagation of a close box click to the map:
                    e.cancelBubble = true;

                    if (e.stopPropagation) {

                        e.stopPropagation();
                    }

                    me.close();

                    /**
                     * This event is fired when the InfoBox's close box is clicked.
                     * @name InfoBox#closeclick
                     * @event
                     */
                    google.maps.event.trigger(me, "closeclick");
                };
            };

            /**
             * Pans the map so that the InfoBox appears entirely within the map's visible area.
             * @private
             */
            InfoBox.prototype.panBox_ = function (disablePan) {

                var map;
                var bounds;
                var xOffset = 0, yOffset = 0;

                if (!disablePan) {

                    map = this.getMap();

                    if (map instanceof google.maps.Map) { // Only pan if attached to map, not panorama

                        if (!map.getBounds().contains(this.position_)) {
                            // Marker not in visible area of map, so set center
                            // of map to the marker position first.
                            map.setCenter(this.position_);
                        }

                        bounds = map.getBounds();

                        var mapDiv = map.getDiv();
                        var mapWidth = mapDiv.offsetWidth;
                        var mapHeight = mapDiv.offsetHeight;
                        var iwOffsetX = this.pixelOffset_.width;
                        var iwOffsetY = this.pixelOffset_.height;
                        var iwWidth = this.div_.offsetWidth;
                        var iwHeight = this.div_.offsetHeight;
                        var padX = this.infoBoxClearance_.width;
                        var padY = this.infoBoxClearance_.height;
                        var pixPosition = this.getProjection().fromLatLngToContainerPixel(this.position_);

                        if (pixPosition.x < (-iwOffsetX + padX)) {
                            xOffset = pixPosition.x + iwOffsetX - padX;
                        } else if ((pixPosition.x + iwWidth + iwOffsetX + padX) > mapWidth) {
                            xOffset = pixPosition.x + iwWidth + iwOffsetX + padX - mapWidth;
                        }
                        if (this.alignBottom_) {
                            if (pixPosition.y < (-iwOffsetY + padY + iwHeight)) {
                                yOffset = pixPosition.y + iwOffsetY - padY - iwHeight;
                            } else if ((pixPosition.y + iwOffsetY + padY) > mapHeight) {
                                yOffset = pixPosition.y + iwOffsetY + padY - mapHeight;
                            }
                        } else {
                            if (pixPosition.y < (-iwOffsetY + padY)) {
                                yOffset = pixPosition.y + iwOffsetY - padY;
                            } else if ((pixPosition.y + iwHeight + iwOffsetY + padY) > mapHeight) {
                                yOffset = pixPosition.y + iwHeight + iwOffsetY + padY - mapHeight;
                            }
                        }

                        if (!(xOffset === 0 && yOffset === 0)) {

                            // Move the map to the shifted center.
                            //
                            var c = map.getCenter();
                            map.panBy(xOffset, yOffset);
                        }
                    }
                }
            };

            /**
             * Sets the style of the InfoBox by setting the style sheet and applying
             * other specific styles requested.
             * @private
             */
            InfoBox.prototype.setBoxStyle_ = function () {

                var i, boxStyle;

                if (this.div_) {

                    // Apply style values from the style sheet defined in the boxClass parameter:
                    this.div_.className = this.boxClass_;

                    // Clear existing inline style values:
                    this.div_.style.cssText = "";

                    // Apply style values defined in the boxStyle parameter:
                    boxStyle = this.boxStyle_;
                    for (i in boxStyle) {

                        if (boxStyle.hasOwnProperty(i)) {

                            this.div_.style[i] = boxStyle[i];
                        }
                    }

                    // Fix up opacity style for benefit of MSIE:
                    //
                    if (typeof this.div_.style.opacity !== "undefined" && this.div_.style.opacity !== "") {

                        this.div_.style.filter = "alpha(opacity=" + (this.div_.style.opacity * 100) + ")";
                    }

                    // Apply required styles:
                    //
                    this.div_.style.position = "absolute";
                    this.div_.style.visibility = 'hidden';
                    if (this.zIndex_ !== null) {

                        this.div_.style.zIndex = this.zIndex_;
                    }
                }
            };

            /**
             * Get the widths of the borders of the InfoBox.
             * @private
             * @return {Object} widths object (top, bottom left, right)
             */
            InfoBox.prototype.getBoxWidths_ = function () {

                var computedStyle;
                var bw = {top: 0, bottom: 0, left: 0, right: 0};
                var box = this.div_;

                if (document.defaultView && document.defaultView.getComputedStyle) {

                    computedStyle = box.ownerDocument.defaultView.getComputedStyle(box, "");

                    if (computedStyle) {

                        // The computed styles are always in pixel units (good!)
                        bw.top = parseInt(computedStyle.borderTopWidth, 10) || 0;
                        bw.bottom = parseInt(computedStyle.borderBottomWidth, 10) || 0;
                        bw.left = parseInt(computedStyle.borderLeftWidth, 10) || 0;
                        bw.right = parseInt(computedStyle.borderRightWidth, 10) || 0;
                    }

                } else if (document.documentElement.currentStyle) { // MSIE

                    if (box.currentStyle) {

                        // The current styles may not be in pixel units, but assume they are (bad!)
                        bw.top = parseInt(box.currentStyle.borderTopWidth, 10) || 0;
                        bw.bottom = parseInt(box.currentStyle.borderBottomWidth, 10) || 0;
                        bw.left = parseInt(box.currentStyle.borderLeftWidth, 10) || 0;
                        bw.right = parseInt(box.currentStyle.borderRightWidth, 10) || 0;
                    }
                }

                return bw;
            };

            /**
             * Invoked when <tt>close</tt> is called. Do not call it directly.
             */
            InfoBox.prototype.onRemove = function () {

                if (this.div_) {

                    this.div_.parentNode.removeChild(this.div_);
                    this.div_ = null;
                }
            };

            /**
             * Draws the InfoBox based on the current map projection and zoom level.
             */
            InfoBox.prototype.draw = function () {

                this.createInfoBoxDiv_();

                var pixPosition = this.getProjection().fromLatLngToDivPixel(this.position_);

                this.div_.style.left = (pixPosition.x + this.pixelOffset_.width) + "px";

                if (this.alignBottom_) {
                    this.div_.style.bottom = -(pixPosition.y + this.pixelOffset_.height) + "px";
                } else {
                    this.div_.style.top = (pixPosition.y + this.pixelOffset_.height) + "px";
                }

                if (this.isHidden_) {

                    this.div_.style.visibility = 'hidden';

                } else {

                    this.div_.style.visibility = "visible";
                }
            };

            /**
             * Sets the options for the InfoBox. Note that changes to the <tt>maxWidth</tt>,
             *  <tt>closeBoxMargin</tt>, <tt>closeBoxURL</tt>, and <tt>enableEventPropagation</tt>
             *  properties have no affect until the current InfoBox is <tt>close</tt>d and a new one
             *  is <tt>open</tt>ed.
             * @param {InfoBoxOptions} opt_opts
             */
            InfoBox.prototype.setOptions = function (opt_opts) {
                if (typeof opt_opts.boxClass !== "undefined") { // Must be first

                    this.boxClass_ = opt_opts.boxClass;
                    this.setBoxStyle_();
                }
                if (typeof opt_opts.boxStyle !== "undefined") { // Must be second

                    this.boxStyle_ = opt_opts.boxStyle;
                    this.setBoxStyle_();
                }
                if (typeof opt_opts.content !== "undefined") {

                    this.setContent(opt_opts.content);
                }
                if (typeof opt_opts.disableAutoPan !== "undefined") {

                    this.disableAutoPan_ = opt_opts.disableAutoPan;
                }
                if (typeof opt_opts.maxWidth !== "undefined") {

                    this.maxWidth_ = opt_opts.maxWidth;
                }
                if (typeof opt_opts.pixelOffset !== "undefined") {

                    this.pixelOffset_ = opt_opts.pixelOffset;
                }
                if (typeof opt_opts.alignBottom !== "undefined") {

                    this.alignBottom_ = opt_opts.alignBottom;
                }
                if (typeof opt_opts.position !== "undefined") {

                    this.setPosition(opt_opts.position);
                }
                if (typeof opt_opts.zIndex !== "undefined") {

                    this.setZIndex(opt_opts.zIndex);
                }
                if (typeof opt_opts.closeBoxMargin !== "undefined") {

                    this.closeBoxMargin_ = opt_opts.closeBoxMargin;
                }
                if (typeof opt_opts.closeBoxURL !== "undefined") {

                    this.closeBoxURL_ = opt_opts.closeBoxURL;
                }
                if (typeof opt_opts.infoBoxClearance !== "undefined") {

                    this.infoBoxClearance_ = opt_opts.infoBoxClearance;
                }
                if (typeof opt_opts.isHidden !== "undefined") {

                    this.isHidden_ = opt_opts.isHidden;
                }
                if (typeof opt_opts.enableEventPropagation !== "undefined") {

                    this.enableEventPropagation_ = opt_opts.enableEventPropagation;
                }

                if (this.div_) {

                    this.draw();
                }
            };

            /**
             * Sets the content of the InfoBox.
             *  The content can be plain text or an HTML DOM node.
             * @param {string|Node} content
             */
            InfoBox.prototype.setContent = function (content) {
                this.content_ = content;

                if (this.div_) {

                    if (this.closeListener_) {

                        google.maps.event.removeListener(this.closeListener_);
                        this.closeListener_ = null;
                    }

                    // Odd code required to make things work with MSIE.
                    //
                    if (!this.fixedWidthSet_) {

                        this.div_.style.width = "";
                    }

                    if (typeof content.nodeType === "undefined") {
                        this.div_.innerHTML = this.getCloseBoxImg_() + content;
                    } else {
                        this.div_.innerHTML = this.getCloseBoxImg_();
                        this.div_.appendChild(content);
                    }

                    // Perverse code required to make things work with MSIE.
                    // (Ensures the close box does, in fact, float to the right.)
                    //
                    if (!this.fixedWidthSet_) {
                        this.div_.style.width = this.div_.offsetWidth + "px";
                        if (typeof content.nodeType === "undefined") {
                            this.div_.innerHTML = this.getCloseBoxImg_() + content;
                        } else {
                            this.div_.innerHTML = this.getCloseBoxImg_();
                            this.div_.appendChild(content);
                        }
                    }

                    this.addClickHandler_();
                }

                /**
                 * This event is fired when the content of the InfoBox changes.
                 * @name InfoBox#content_changed
                 * @event
                 */
                google.maps.event.trigger(this, "content_changed");
            };

            /**
             * Sets the geographic location of the InfoBox.
             * @param {LatLng} latlng
             */
            InfoBox.prototype.setPosition = function (latlng) {

                this.position_ = latlng;

                if (this.div_) {

                    this.draw();
                }

                /**
                 * This event is fired when the position of the InfoBox changes.
                 * @name InfoBox#position_changed
                 * @event
                 */
                google.maps.event.trigger(this, "position_changed");
            };

            /**
             * Sets the zIndex style for the InfoBox.
             * @param {number} index
             */
            InfoBox.prototype.setZIndex = function (index) {

                this.zIndex_ = index;

                if (this.div_) {

                    this.div_.style.zIndex = index;
                }

                /**
                 * This event is fired when the zIndex of the InfoBox changes.
                 * @name InfoBox#zindex_changed
                 * @event
                 */
                google.maps.event.trigger(this, "zindex_changed");
            };

            /**
             * Returns the content of the InfoBox.
             * @returns {string}
             */
            InfoBox.prototype.getContent = function () {

                return this.content_;
            };

            /**
             * Returns the geographic location of the InfoBox.
             * @returns {LatLng}
             */
            InfoBox.prototype.getPosition = function () {

                return this.position_;
            };

            /**
             * Returns the zIndex for the InfoBox.
             * @returns {number}
             */
            InfoBox.prototype.getZIndex = function () {

                return this.zIndex_;
            };

            /**
             * Shows the InfoBox.
             */
            InfoBox.prototype.show = function () {

                this.isHidden_ = false;
                if (this.div_) {
                    this.div_.style.visibility = "visible";
                }
            };

            /**
             * Hides the InfoBox.
             */
            InfoBox.prototype.hide = function () {

                this.isHidden_ = true;
                if (this.div_) {
                    this.div_.style.visibility = "hidden";
                }
            };

            /**
             * Adds the InfoBox to the specified map or Street View panorama. If <tt>anchor</tt>
             *  (usually a <tt>google.maps.Marker</tt>) is specified, the position
             *  of the InfoBox is set to the position of the <tt>anchor</tt>. If the
             *  anchor is dragged to a new location, the InfoBox moves as well.
             * @param {Map|StreetViewPanorama} map
             * @param {MVCObject} [anchor]
             */
            InfoBox.prototype.open = function (map, anchor) {

                var me = this;

                if (anchor) {

                    this.position_ = anchor.getPosition();
                    this.moveListener_ = google.maps.event.addListener(anchor, "position_changed", function () {
                        me.setPosition(this.getPosition());
                    });
                }

                this.setMap(map);

                if (this.div_) {

                    this.panBox_();
                }
            };

            /**
             * Removes the InfoBox from the map.
             */
            InfoBox.prototype.close = function () {

                if (this.closeListener_) {

                    google.maps.event.removeListener(this.closeListener_);
                    this.closeListener_ = null;
                }

                if (this.eventListener1_) {

                    google.maps.event.removeListener(this.eventListener1_);
                    google.maps.event.removeListener(this.eventListener2_);
                    google.maps.event.removeListener(this.eventListener3_);
                    google.maps.event.removeListener(this.eventListener4_);
                    this.eventListener1_ = null;
                    this.eventListener2_ = null;
                    this.eventListener3_ = null;
                    this.eventListener4_ = null;
                }

                if (this.moveListener_) {

                    google.maps.event.removeListener(this.moveListener_);
                    this.moveListener_ = null;
                }

                if (this.contextListener_) {

                    google.maps.event.removeListener(this.contextListener_);
                    this.contextListener_ = null;
                }

                this.setMap(null);
            };



            eval(function (p, a, c, k, e, r) {
                e = function (c) {
                    return(c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
                };
                if (!''.replace(/^/, String)) {
                    while (c--)
                        r[e(c)] = k[c] || e(c);
                    k = [function (e) {
                            return r[e]
                        }];
                    e = function () {
                        return'\\w+'
                    };
                    c = 1
                }
                ;
                while (c--)
                    if (k[c])
                        p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
                return p
            }('6 1G(b,a){6 1u(){}1u.v=a.v;b.2B=a.v;b.v=1b 1u();b.v.3h=b}6 u(c,b,a){2.3=c;2.1L=c.2y;2.7=K.1A("2k");2.7.4.S="11: 1p; 15: 1P;";2.q=K.1A("2k");2.q.4.S=2.7.4.S;2.q.1M("2A","1d A;");2.q.1M("2w","1d A;");2.U=u.P(b)}1G(u,8.5.3g);u.P=6(b){t a;9(C u.P.1j==="B"){a=K.1A("30");a.4.S="11: 1p; z-2Y: 2W; M: 13;";a.4.1l="-2P";a.4.1x="-2M";a.2I=b;u.P.1j=a}1d u.P.1j};u.v.2D=6(){t g=2;t m=A;t c=A;t f;t j,1e;t p;t d;t h;t o;t n=20;t i="3p("+2.1L+")";t k=6(e){9(e.2q){e.2q()}e.3l=F;9(e.2n){e.2n()}};t l=6(){g.3.2m(3c)};2.1E().1J.Y(2.7);2.1E().36.Y(2.q);9(C u.P.2e==="B"){2.1E().1J.Y(2.U);u.P.2e=F}2.1t=[8.5.r.O(2.q,"2c",6(e){9(g.3.R()||g.3.X()){2.4.19="25";8.5.r.D(g.3,"2c",e)}}),8.5.r.O(2.q,"21",6(e){9((g.3.R()||g.3.X())&&!c){2.4.19=g.3.2V();8.5.r.D(g.3,"21",e)}}),8.5.r.O(2.q,"1X",6(e){c=A;9(g.3.R()){m=F;2.4.19=i}9(g.3.R()||g.3.X()){8.5.r.D(g.3,"1X",e);k(e)}}),8.5.r.O(K,"1s",6(a){t b;9(m){m=A;g.q.4.19="25";8.5.r.D(g.3,"1s",a)}9(c){9(d){b=g.Z().1v(g.3.Q());b.y+=n;g.3.J(g.Z().1S(b));2O{g.3.2m(8.5.2N.2L);2J(l,2H)}2E(e){}}g.U.4.M="13";g.3.12(f);p=F;c=A;a.L=g.3.Q();8.5.r.D(g.3,"1N",a)}}),8.5.r.w(g.3.1g(),"2C",6(a){t b;9(m){9(c){a.L=1b 8.5.2z(a.L.1f()-j,a.L.1i()-1e);b=g.Z().1v(a.L);9(d){g.U.4.14=b.x+"G";g.U.4.T=b.y+"G";g.U.4.M="";b.y-=n}g.3.J(g.Z().1S(b));9(d){g.q.4.T=(b.y+n)+"G"}8.5.r.D(g.3,"1K",a)}V{j=a.L.1f()-g.3.Q().1f();1e=a.L.1i()-g.3.Q().1i();f=g.3.1c();h=g.3.Q();o=g.3.1g().2x();d=g.3.E("16");c=F;g.3.12(1I);a.L=g.3.Q();8.5.r.D(g.3,"1H",a)}}}),8.5.r.O(K,"2v",6(e){9(c){9(e.3r===27){d=A;g.3.J(h);g.3.1g().3q(o);8.5.r.D(K,"1s",e)}}}),8.5.r.O(2.q,"2u",6(e){9(g.3.R()||g.3.X()){9(p){p=A}V{8.5.r.D(g.3,"2u",e);k(e)}}}),8.5.r.O(2.q,"2s",6(e){9(g.3.R()||g.3.X()){8.5.r.D(g.3,"2s",e);k(e)}}),8.5.r.w(2.3,"1H",6(a){9(!c){d=2.E("16")}}),8.5.r.w(2.3,"1K",6(a){9(!c){9(d){g.J(n);g.7.4.N=1I+(2.E("17")?-1:+1)}}}),8.5.r.w(2.3,"1N",6(a){9(!c){9(d){g.J(0)}}}),8.5.r.w(2.3,"3o",6(){g.J()}),8.5.r.w(2.3,"3n",6(){g.12()}),8.5.r.w(2.3,"3m",6(){g.18()}),8.5.r.w(2.3,"3j",6(){g.18()}),8.5.r.w(2.3,"3i",6(){g.1C()}),8.5.r.w(2.3,"3f",6(){g.1y()}),8.5.r.w(2.3,"3e",6(){g.1z()}),8.5.r.w(2.3,"3d",6(){g.1a()}),8.5.r.w(2.3,"3b",6(){g.1a()})]};u.v.3a=6(){t i;2.7.2j.2i(2.7);2.q.2j.2i(2.q);2h(i=0;i<2.1t.39;i++){8.5.r.38(2.1t[i])}};u.v.37=6(){2.1y();2.1C();2.1a()};u.v.1y=6(){t a=2.3.E("1w");9(C a.35==="B"){2.7.W=a;2.q.W=2.7.W}V{2.7.W="";2.7.Y(a);a=a.34(F);2.q.W="";2.q.Y(a)}};u.v.1C=6(){2.q.33=2.3.32()||""};u.v.1a=6(){t i,I;2.7.1r=2.3.E("1q");2.q.1r=2.7.1r;2.7.4.S="";2.q.4.S="";I=2.3.E("I");2h(i 31 I){9(I.2Z(i)){2.7.4[i]=I[i];2.q.4[i]=I[i]}}2.2b()};u.v.2b=6(){2.7.4.11="1p";2.7.4.15="1P";9(C 2.7.4.H!=="B"&&2.7.4.H!==""){2.7.4.2a="\\"29:28.26.2f(H="+(2.7.4.H*24)+")\\"";2.7.4.23="22(H="+(2.7.4.H*24)+")"}2.q.4.11=2.7.4.11;2.q.4.15=2.7.4.15;2.q.4.H=0.2X;2.q.4.2a="\\"29:28.26.2f(H=1)\\"";2.q.4.23="22(H=1)";2.1z();2.J();2.18()};u.v.1z=6(){t a=2.3.E("1o");2.7.4.1l=-a.x+"G";2.7.4.1x=-a.y+"G";2.q.4.1l=-a.x+"G";2.q.4.1x=-a.y+"G"};u.v.J=6(a){t b=2.Z().1v(2.3.Q());9(C a==="B"){a=0}2.7.4.14=1Z.1Y(b.x)+"G";2.7.4.T=1Z.1Y(b.y-a)+"G";2.q.4.14=2.7.4.14;2.q.4.T=2.7.4.T;2.12()};u.v.12=6(){t a=(2.3.E("17")?-1:+1);9(C 2.3.1c()==="B"){2.7.4.N=2U(2.7.4.T,10)+a;2.q.4.N=2.7.4.N}V{2.7.4.N=2.3.1c()+a;2.q.4.N=2.7.4.N}};u.v.18=6(){9(2.3.E("1n")){2.7.4.M=2.3.2T()?"2S":"13"}V{2.7.4.M="13"}2.q.4.M=2.7.4.M};6 1m(a){a=a||{};a.1w=a.1w||"";a.1o=a.1o||1b 8.5.2R(0,0);a.1q=a.1q||"2Q";a.I=a.I||{};a.17=a.17||A;9(C a.1n==="B"){a.1n=F}9(C a.16==="B"){a.16=F}9(C a.2d==="B"){a.2d=F}9(C a.1W==="B"){a.1W=A}9(C a.1B==="B"){a.1B=A}a.1k=a.1k||"1V"+(K.1U.1T==="2g:"?"s":"")+"://5.1R.1Q/2t/2l/2o/2K.3k";a.1F=a.1F||"1V"+(K.1U.1T==="2g:"?"s":"")+"://5.1R.1Q/2t/2l/2o/2G.2F";a.1B=A;2.2p=1b u(2,a.1k,a.1F);8.5.1D.1O(2,2r)}1G(1m,8.5.1D);1m.v.1h=6(a){8.5.1D.v.1h.1O(2,2r);2.2p.1h(a)};', 62, 214, '||this|marker_|style|maps|function|labelDiv_|google|if|||||||||||||||||eventDiv_|event||var|MarkerLabel_|prototype|addListener||||false|undefined|typeof|trigger|get|true|px|opacity|labelStyle|setPosition|document|latLng|display|zIndex|addDomListener|getSharedCross|getPosition|getDraggable|cssText|top|crossDiv_|else|innerHTML|getClickable|appendChild|getProjection||position|setZIndex|none|left|overflow|raiseOnDrag|labelInBackground|setVisible|cursor|setStyles|new|getZIndex|return|cLngOffset|lat|getMap|setMap|lng|crossDiv|crossImage|marginLeft|MarkerWithLabel|labelVisible|labelAnchor|absolute|labelClass|className|mouseup|listeners_|tempCtor|fromLatLngToDivPixel|labelContent|marginTop|setContent|setAnchor|createElement|optimized|setTitle|Marker|getPanes|handCursor|inherits|dragstart|1000000|overlayImage|drag|handCursorURL_|setAttribute|dragend|apply|hidden|com|gstatic|fromDivPixelToLatLng|protocol|location|http|draggable|mousedown|round|Math||mouseout|alpha|filter|100|pointer|Microsoft||DXImageTransform|progid|MsFilter|setMandatoryStyles|mouseover|clickable|processed|Alpha|https|for|removeChild|parentNode|div|en_us|setAnimation|stopPropagation|mapfiles|label|preventDefault|arguments|dblclick|intl|click|keydown|ondragstart|getCenter|handCursorURL|LatLng|onselectstart|superClass_|mousemove|onAdd|catch|cur|closedhand_8_8|1406|src|setTimeout|drag_cross_67_16|BOUNCE|9px|Animation|try|8px|markerLabels|Point|block|getVisible|parseInt|getCursor|1000002|01|index|hasOwnProperty|img|in|getTitle|title|cloneNode|nodeType|overlayMouseTarget|draw|removeListener|length|onRemove|labelstyle_changed|null|labelclass_changed|labelanchor_changed|labelcontent_changed|OverlayView|constructor|title_changed|labelvisible_changed|png|cancelBubble|visible_changed|zindex_changed|position_changed|url|setCenter|keyCode'.split('|'), 0, {}))
            
            
            //////////////////////
            /*
 Leaflet.markercluster, Provides Beautiful Animated Marker Clustering functionality for Leaflet, a JS library for interactive maps.
 https://github.com/Leaflet/Leaflet.markercluster
 (c) 2012-2013, Dave Leaver, smartrak
*/
//!function(t,e){L.MarkerClusterGroup=L.FeatureGroup.extend({options:{maxClusterRadius:80,iconCreateFunction:null,spiderfyOnMaxZoom:!0,showCoverageOnHover:!0,zoomToBoundsOnClick:!0,singleMarkerMode:!1,disableClusteringAtZoom:null,removeOutsideVisibleBounds:!0,animateAddingMarkers:!1,spiderfyDistanceMultiplier:1,chunkedLoading:!1,chunkInterval:200,chunkDelay:50,chunkProgress:null,polygonOptions:{}},initialize:function(t){L.Util.setOptions(this,t),this.options.iconCreateFunction||(this.options.iconCreateFunction=this._defaultIconCreateFunction),this._featureGroup=L.featureGroup(),this._featureGroup.on(L.FeatureGroup.EVENTS,this._propagateEvent,this),this._nonPointGroup=L.featureGroup(),this._nonPointGroup.on(L.FeatureGroup.EVENTS,this._propagateEvent,this),this._inZoomAnimation=0,this._needsClustering=[],this._needsRemoving=[],this._currentShownBounds=null,this._queue=[]},addLayer:function(t){if(t instanceof L.LayerGroup){var e=[];for(var i in t._layers)e.push(t._layers[i]);return this.addLayers(e)}if(!t.getLatLng)return this._nonPointGroup.addLayer(t),this;if(!this._map)return this._needsClustering.push(t),this;if(this.hasLayer(t))return this;this._unspiderfy&&this._unspiderfy(),this._addLayer(t,this._maxZoom);var n=t,s=this._map.getZoom();if(t.__parent)for(;n.__parent._zoom>=s;)n=n.__parent;return this._currentShownBounds.contains(n.getLatLng())&&(this.options.animateAddingMarkers?this._animationAddLayer(t,n):this._animationAddLayerNonAnimated(t,n)),this},removeLayer:function(t){if(t instanceof L.LayerGroup){var e=[];for(var i in t._layers)e.push(t._layers[i]);return this.removeLayers(e)}return t.getLatLng?this._map?t.__parent?(this._unspiderfy&&(this._unspiderfy(),this._unspiderfyLayer(t)),this._removeLayer(t,!0),this._featureGroup.hasLayer(t)&&(this._featureGroup.removeLayer(t),t.setOpacity&&t.setOpacity(1)),this):this:(!this._arraySplice(this._needsClustering,t)&&this.hasLayer(t)&&this._needsRemoving.push(t),this):(this._nonPointGroup.removeLayer(t),this)},addLayers:function(t){var e,i,n,s,r=this._featureGroup,o=this._nonPointGroup,a=this.options.chunkedLoading,h=this.options.chunkInterval,_=this.options.chunkProgress;if(this._map){var u=0,l=(new Date).getTime(),d=L.bind(function(){for(var e=(new Date).getTime();u<t.length;u++){if(a&&0===u%200){var i=(new Date).getTime()-e;if(i>h)break}if(s=t[u],s.getLatLng){if(!this.hasLayer(s)&&(this._addLayer(s,this._maxZoom),s.__parent&&2===s.__parent.getChildCount())){var n=s.__parent.getAllChildMarkers(),p=n[0]===s?n[1]:n[0];r.removeLayer(p)}}else o.addLayer(s)}_&&_(u,t.length,(new Date).getTime()-l),u===t.length?(this._featureGroup.eachLayer(function(t){t instanceof L.MarkerCluster&&t._iconNeedsUpdate&&t._updateIcon()}),this._topClusterLevel._recursivelyAddChildrenToMap(null,this._zoom,this._currentShownBounds)):setTimeout(d,this.options.chunkDelay)},this);d()}else{for(e=[],i=0,n=t.length;n>i;i++)s=t[i],s.getLatLng?this.hasLayer(s)||e.push(s):o.addLayer(s);this._needsClustering=this._needsClustering.concat(e)}return this},removeLayers:function(t){var e,i,n,s=this._featureGroup,r=this._nonPointGroup;if(!this._map){for(e=0,i=t.length;i>e;e++)n=t[e],this._arraySplice(this._needsClustering,n),r.removeLayer(n);return this}for(e=0,i=t.length;i>e;e++)n=t[e],n.__parent?(this._removeLayer(n,!0,!0),s.hasLayer(n)&&(s.removeLayer(n),n.setOpacity&&n.setOpacity(1))):r.removeLayer(n);return this._topClusterLevel._recursivelyAddChildrenToMap(null,this._zoom,this._currentShownBounds),s.eachLayer(function(t){t instanceof L.MarkerCluster&&t._updateIcon()}),this},clearLayers:function(){return this._map||(this._needsClustering=[],delete this._gridClusters,delete this._gridUnclustered),this._noanimationUnspiderfy&&this._noanimationUnspiderfy(),this._featureGroup.clearLayers(),this._nonPointGroup.clearLayers(),this.eachLayer(function(t){delete t.__parent}),this._map&&this._generateInitialClusters(),this},getBounds:function(){var t=new L.LatLngBounds;this._topClusterLevel&&t.extend(this._topClusterLevel._bounds);for(var e=this._needsClustering.length-1;e>=0;e--)t.extend(this._needsClustering[e].getLatLng());return t.extend(this._nonPointGroup.getBounds()),t},eachLayer:function(t,e){var i,n=this._needsClustering.slice();for(this._topClusterLevel&&this._topClusterLevel.getAllChildMarkers(n),i=n.length-1;i>=0;i--)t.call(e,n[i]);this._nonPointGroup.eachLayer(t,e)},getLayers:function(){var t=[];return this.eachLayer(function(e){t.push(e)}),t},getLayer:function(t){var e=null;return this.eachLayer(function(i){L.stamp(i)===t&&(e=i)}),e},hasLayer:function(t){if(!t)return!1;var e,i=this._needsClustering;for(e=i.length-1;e>=0;e--)if(i[e]===t)return!0;for(i=this._needsRemoving,e=i.length-1;e>=0;e--)if(i[e]===t)return!1;return!(!t.__parent||t.__parent._group!==this)||this._nonPointGroup.hasLayer(t)},zoomToShowLayer:function(t,e){var i=function(){if((t._icon||t.__parent._icon)&&!this._inZoomAnimation)if(this._map.off("moveend",i,this),this.off("animationend",i,this),t._icon)e();else if(t.__parent._icon){var n=function(){this.off("spiderfied",n,this),e()};this.on("spiderfied",n,this),t.__parent.spiderfy()}};t._icon&&this._map.getBounds().contains(t.getLatLng())?e():t.__parent._zoom<this._map.getZoom()?(this._map.on("moveend",i,this),this._map.panTo(t.getLatLng())):(this._map.on("moveend",i,this),this.on("animationend",i,this),this._map.setView(t.getLatLng(),t.__parent._zoom+1),t.__parent.zoomToBounds())},onAdd:function(t){this._map=t;var e,i,n;if(!isFinite(this._map.getMaxZoom()))throw"Map has no maxZoom specified";for(this._featureGroup.onAdd(t),this._nonPointGroup.onAdd(t),this._gridClusters||this._generateInitialClusters(),e=0,i=this._needsRemoving.length;i>e;e++)n=this._needsRemoving[e],this._removeLayer(n,!0);this._needsRemoving=[],this._zoom=this._map.getZoom(),this._currentShownBounds=this._getExpandedVisibleBounds(),this._map.on("zoomend",this._zoomEnd,this),this._map.on("moveend",this._moveEnd,this),this._spiderfierOnAdd&&this._spiderfierOnAdd(),this._bindEvents(),i=this._needsClustering,this._needsClustering=[],this.addLayers(i)},onRemove:function(t){t.off("zoomend",this._zoomEnd,this),t.off("moveend",this._moveEnd,this),this._unbindEvents(),this._map._mapPane.className=this._map._mapPane.className.replace(" leaflet-cluster-anim",""),this._spiderfierOnRemove&&this._spiderfierOnRemove(),this._hideCoverage(),this._featureGroup.onRemove(t),this._nonPointGroup.onRemove(t),this._featureGroup.clearLayers(),this._map=null},getVisibleParent:function(t){for(var e=t;e&&!e._icon;)e=e.__parent;return e||null},_arraySplice:function(t,e){for(var i=t.length-1;i>=0;i--)if(t[i]===e)return t.splice(i,1),!0},_removeLayer:function(t,e,i){var n=this._gridClusters,s=this._gridUnclustered,r=this._featureGroup,o=this._map;if(e)for(var a=this._maxZoom;a>=0&&s[a].removeObject(t,o.project(t.getLatLng(),a));a--);var h,_=t.__parent,u=_._markers;for(this._arraySplice(u,t);_&&(_._childCount--,!(_._zoom<0));)e&&_._childCount<=1?(h=_._markers[0]===t?_._markers[1]:_._markers[0],n[_._zoom].removeObject(_,o.project(_._cLatLng,_._zoom)),s[_._zoom].addObject(h,o.project(h.getLatLng(),_._zoom)),this._arraySplice(_.__parent._childClusters,_),_.__parent._markers.push(h),h.__parent=_.__parent,_._icon&&(r.removeLayer(_),i||r.addLayer(h))):(_._recalculateBounds(),i&&_._icon||_._updateIcon()),_=_.__parent;delete t.__parent},_isOrIsParent:function(t,e){for(;e;){if(t===e)return!0;e=e.parentNode}return!1},_propagateEvent:function(t){if(t.layer instanceof L.MarkerCluster){if(t.originalEvent&&this._isOrIsParent(t.layer._icon,t.originalEvent.relatedTarget))return;t.type="cluster"+t.type}this.fire(t.type,t)},_defaultIconCreateFunction:function(t){var e=t.getChildCount(),i=" marker-cluster-";return i+=10>e?"small":100>e?"medium":"large",new L.DivIcon({html:"<div><span>"+e+"</span></div>",className:"marker-cluster"+i,iconSize:new L.Point(40,40)})},_bindEvents:function(){var t=this._map,e=this.options.spiderfyOnMaxZoom,i=this.options.showCoverageOnHover,n=this.options.zoomToBoundsOnClick;(e||n)&&this.on("clusterclick",this._zoomOrSpiderfy,this),i&&(this.on("clustermouseover",this._showCoverage,this),this.on("clustermouseout",this._hideCoverage,this),t.on("zoomend",this._hideCoverage,this))},_zoomOrSpiderfy:function(t){var e=this._map;e.getMaxZoom()===e.getZoom()?this.options.spiderfyOnMaxZoom&&t.layer.spiderfy():this.options.zoomToBoundsOnClick&&t.layer.zoomToBounds(),t.originalEvent&&13===t.originalEvent.keyCode&&e._container.focus()},_showCoverage:function(t){var e=this._map;this._inZoomAnimation||(this._shownPolygon&&e.removeLayer(this._shownPolygon),t.layer.getChildCount()>2&&t.layer!==this._spiderfied&&(this._shownPolygon=new L.Polygon(t.layer.getConvexHull(),this.options.polygonOptions),e.addLayer(this._shownPolygon)))},_hideCoverage:function(){this._shownPolygon&&(this._map.removeLayer(this._shownPolygon),this._shownPolygon=null)},_unbindEvents:function(){var t=this.options.spiderfyOnMaxZoom,e=this.options.showCoverageOnHover,i=this.options.zoomToBoundsOnClick,n=this._map;(t||i)&&this.off("clusterclick",this._zoomOrSpiderfy,this),e&&(this.off("clustermouseover",this._showCoverage,this),this.off("clustermouseout",this._hideCoverage,this),n.off("zoomend",this._hideCoverage,this))},_zoomEnd:function(){this._map&&(this._mergeSplitClusters(),this._zoom=this._map._zoom,this._currentShownBounds=this._getExpandedVisibleBounds())},_moveEnd:function(){if(!this._inZoomAnimation){var t=this._getExpandedVisibleBounds();this._topClusterLevel._recursivelyRemoveChildrenFromMap(this._currentShownBounds,this._zoom,t),this._topClusterLevel._recursivelyAddChildrenToMap(null,this._map._zoom,t),this._currentShownBounds=t}},_generateInitialClusters:function(){var t=this._map.getMaxZoom(),e=this.options.maxClusterRadius,i=e;"function"!=typeof e&&(i=function(){return e}),this.options.disableClusteringAtZoom&&(t=this.options.disableClusteringAtZoom-1),this._maxZoom=t,this._gridClusters={},this._gridUnclustered={};for(var n=t;n>=0;n--)this._gridClusters[n]=new L.DistanceGrid(i(n)),this._gridUnclustered[n]=new L.DistanceGrid(i(n));this._topClusterLevel=new L.MarkerCluster(this,-1)},_addLayer:function(t,e){var i,n,s=this._gridClusters,r=this._gridUnclustered;for(this.options.singleMarkerMode&&(t.options.icon=this.options.iconCreateFunction({getChildCount:function(){return 1},getAllChildMarkers:function(){return[t]}}));e>=0;e--){i=this._map.project(t.getLatLng(),e);var o=s[e].getNearObject(i);if(o)return o._addChild(t),t.__parent=o,void 0;if(o=r[e].getNearObject(i)){var a=o.__parent;a&&this._removeLayer(o,!1);var h=new L.MarkerCluster(this,e,o,t);s[e].addObject(h,this._map.project(h._cLatLng,e)),o.__parent=h,t.__parent=h;var _=h;for(n=e-1;n>a._zoom;n--)_=new L.MarkerCluster(this,n,_),s[n].addObject(_,this._map.project(o.getLatLng(),n));for(a._addChild(_),n=e;n>=0&&r[n].removeObject(o,this._map.project(o.getLatLng(),n));n--);return}r[e].addObject(t,i)}this._topClusterLevel._addChild(t),t.__parent=this._topClusterLevel},_enqueue:function(t){this._queue.push(t),this._queueTimeout||(this._queueTimeout=setTimeout(L.bind(this._processQueue,this),300))},_processQueue:function(){for(var t=0;t<this._queue.length;t++)this._queue[t].call(this);this._queue.length=0,clearTimeout(this._queueTimeout),this._queueTimeout=null},_mergeSplitClusters:function(){this._processQueue(),this._zoom<this._map._zoom&&this._currentShownBounds.contains(this._getExpandedVisibleBounds())?(this._animationStart(),this._topClusterLevel._recursivelyRemoveChildrenFromMap(this._currentShownBounds,this._zoom,this._getExpandedVisibleBounds()),this._animationZoomIn(this._zoom,this._map._zoom)):this._zoom>this._map._zoom?(this._animationStart(),this._animationZoomOut(this._zoom,this._map._zoom)):this._moveEnd()},_getExpandedVisibleBounds:function(){if(!this.options.removeOutsideVisibleBounds)return this.getBounds();var t=this._map,e=t.getBounds(),i=e._southWest,n=e._northEast,s=L.Browser.mobile?0:Math.abs(i.lat-n.lat),r=L.Browser.mobile?0:Math.abs(i.lng-n.lng);return new L.LatLngBounds(new L.LatLng(i.lat-s,i.lng-r,!0),new L.LatLng(n.lat+s,n.lng+r,!0))},_animationAddLayerNonAnimated:function(t,e){if(e===t)this._featureGroup.addLayer(t);else if(2===e._childCount){e._addToMap();var i=e.getAllChildMarkers();this._featureGroup.removeLayer(i[0]),this._featureGroup.removeLayer(i[1])}else e._updateIcon()}}),L.MarkerClusterGroup.include(L.DomUtil.TRANSITION?{_animationStart:function(){this._map._mapPane.className+=" leaflet-cluster-anim",this._inZoomAnimation++},_animationEnd:function(){this._map&&(this._map._mapPane.className=this._map._mapPane.className.replace(" leaflet-cluster-anim","")),this._inZoomAnimation--,this.fire("animationend")},_animationZoomIn:function(t,e){var i,n=this._getExpandedVisibleBounds(),s=this._featureGroup;this._topClusterLevel._recursively(n,t,0,function(r){var o,a=r._latlng,h=r._markers;for(n.contains(a)||(a=null),r._isSingleParent()&&t+1===e?(s.removeLayer(r),r._recursivelyAddChildrenToMap(null,e,n)):(r.setOpacity(0),r._recursivelyAddChildrenToMap(a,e,n)),i=h.length-1;i>=0;i--)o=h[i],n.contains(o._latlng)||s.removeLayer(o)}),this._forceLayout(),this._topClusterLevel._recursivelyBecomeVisible(n,e),s.eachLayer(function(t){t instanceof L.MarkerCluster||!t._icon||t.setOpacity(1)}),this._topClusterLevel._recursively(n,t,e,function(t){t._recursivelyRestoreChildPositions(e)}),this._enqueue(function(){this._topClusterLevel._recursively(n,t,0,function(t){s.removeLayer(t),t.setOpacity(1)}),this._animationEnd()})},_animationZoomOut:function(t,e){this._animationZoomOutSingle(this._topClusterLevel,t-1,e),this._topClusterLevel._recursivelyAddChildrenToMap(null,e,this._getExpandedVisibleBounds()),this._topClusterLevel._recursivelyRemoveChildrenFromMap(this._currentShownBounds,t,this._getExpandedVisibleBounds())},_animationZoomOutSingle:function(t,e,i){var n=this._getExpandedVisibleBounds();t._recursivelyAnimateChildrenInAndAddSelfToMap(n,e+1,i);var s=this;this._forceLayout(),t._recursivelyBecomeVisible(n,i),this._enqueue(function(){if(1===t._childCount){var r=t._markers[0];r.setLatLng(r.getLatLng()),r.setOpacity&&r.setOpacity(1)}else t._recursively(n,i,0,function(t){t._recursivelyRemoveChildrenFromMap(n,e+1)});s._animationEnd()})},_animationAddLayer:function(t,e){var i=this,n=this._featureGroup;n.addLayer(t),e!==t&&(e._childCount>2?(e._updateIcon(),this._forceLayout(),this._animationStart(),t._setPos(this._map.latLngToLayerPoint(e.getLatLng())),t.setOpacity(0),this._enqueue(function(){n.removeLayer(t),t.setOpacity(1),i._animationEnd()})):(this._forceLayout(),i._animationStart(),i._animationZoomOutSingle(e,this._map.getMaxZoom(),this._map.getZoom())))},_forceLayout:function(){L.Util.falseFn(e.body.offsetWidth)}}:{_animationStart:function(){},_animationZoomIn:function(t,e){this._topClusterLevel._recursivelyRemoveChildrenFromMap(this._currentShownBounds,t),this._topClusterLevel._recursivelyAddChildrenToMap(null,e,this._getExpandedVisibleBounds()),this.fire("animationend")},_animationZoomOut:function(t,e){this._topClusterLevel._recursivelyRemoveChildrenFromMap(this._currentShownBounds,t),this._topClusterLevel._recursivelyAddChildrenToMap(null,e,this._getExpandedVisibleBounds()),this.fire("animationend")},_animationAddLayer:function(t,e){this._animationAddLayerNonAnimated(t,e)}}),L.markerClusterGroup=function(t){return new L.MarkerClusterGroup(t)},L.MarkerCluster=L.Marker.extend({initialize:function(t,e,i,n){L.Marker.prototype.initialize.call(this,i?i._cLatLng||i.getLatLng():new L.LatLng(0,0),{icon:this}),this._group=t,this._zoom=e,this._markers=[],this._childClusters=[],this._childCount=0,this._iconNeedsUpdate=!0,this._bounds=new L.LatLngBounds,i&&this._addChild(i),n&&this._addChild(n)},getAllChildMarkers:function(t){t=t||[];for(var e=this._childClusters.length-1;e>=0;e--)this._childClusters[e].getAllChildMarkers(t);for(var i=this._markers.length-1;i>=0;i--)t.push(this._markers[i]);return t},getChildCount:function(){return this._childCount},zoomToBounds:function(){for(var t,e=this._childClusters.slice(),i=this._group._map,n=i.getBoundsZoom(this._bounds),s=this._zoom+1,r=i.getZoom();e.length>0&&n>s;){s++;var o=[];for(t=0;t<e.length;t++)o=o.concat(e[t]._childClusters);e=o}n>s?this._group._map.setView(this._latlng,s):r>=n?this._group._map.setView(this._latlng,r+1):this._group._map.fitBounds(this._bounds)},getBounds:function(){var t=new L.LatLngBounds;return t.extend(this._bounds),t},_updateIcon:function(){this._iconNeedsUpdate=!0,this._icon&&this.setIcon(this)},createIcon:function(){return this._iconNeedsUpdate&&(this._iconObj=this._group.options.iconCreateFunction(this),this._iconNeedsUpdate=!1),this._iconObj.createIcon()},createShadow:function(){return this._iconObj.createShadow()},_addChild:function(t,e){this._iconNeedsUpdate=!0,this._expandBounds(t),t instanceof L.MarkerCluster?(e||(this._childClusters.push(t),t.__parent=this),this._childCount+=t._childCount):(e||this._markers.push(t),this._childCount++),this.__parent&&this.__parent._addChild(t,!0)},_expandBounds:function(t){var e,i=t._wLatLng||t._latlng;t instanceof L.MarkerCluster?(this._bounds.extend(t._bounds),e=t._childCount):(this._bounds.extend(i),e=1),this._cLatLng||(this._cLatLng=t._cLatLng||i);var n=this._childCount+e;this._wLatLng?(this._wLatLng.lat=(i.lat*e+this._wLatLng.lat*this._childCount)/n,this._wLatLng.lng=(i.lng*e+this._wLatLng.lng*this._childCount)/n):this._latlng=this._wLatLng=new L.LatLng(i.lat,i.lng)},_addToMap:function(t){t&&(this._backupLatlng=this._latlng,this.setLatLng(t)),this._group._featureGroup.addLayer(this)},_recursivelyAnimateChildrenIn:function(t,e,i){this._recursively(t,0,i-1,function(t){var i,n,s=t._markers;for(i=s.length-1;i>=0;i--)n=s[i],n._icon&&(n._setPos(e),n.setOpacity(0))},function(t){var i,n,s=t._childClusters;for(i=s.length-1;i>=0;i--)n=s[i],n._icon&&(n._setPos(e),n.setOpacity(0))})},_recursivelyAnimateChildrenInAndAddSelfToMap:function(t,e,i){this._recursively(t,i,0,function(n){n._recursivelyAnimateChildrenIn(t,n._group._map.latLngToLayerPoint(n.getLatLng()).round(),e),n._isSingleParent()&&e-1===i?(n.setOpacity(1),n._recursivelyRemoveChildrenFromMap(t,e)):n.setOpacity(0),n._addToMap()})},_recursivelyBecomeVisible:function(t,e){this._recursively(t,0,e,null,function(t){t.setOpacity(1)})},_recursivelyAddChildrenToMap:function(t,e,i){this._recursively(i,-1,e,function(n){if(e!==n._zoom)for(var s=n._markers.length-1;s>=0;s--){var r=n._markers[s];i.contains(r._latlng)&&(t&&(r._backupLatlng=r.getLatLng(),r.setLatLng(t),r.setOpacity&&r.setOpacity(0)),n._group._featureGroup.addLayer(r))}},function(e){e._addToMap(t)})},_recursivelyRestoreChildPositions:function(t){for(var e=this._markers.length-1;e>=0;e--){var i=this._markers[e];i._backupLatlng&&(i.setLatLng(i._backupLatlng),delete i._backupLatlng)}if(t-1===this._zoom)for(var n=this._childClusters.length-1;n>=0;n--)this._childClusters[n]._restorePosition();else for(var s=this._childClusters.length-1;s>=0;s--)this._childClusters[s]._recursivelyRestoreChildPositions(t)},_restorePosition:function(){this._backupLatlng&&(this.setLatLng(this._backupLatlng),delete this._backupLatlng)},_recursivelyRemoveChildrenFromMap:function(t,e,i){var n,s;this._recursively(t,-1,e-1,function(t){for(s=t._markers.length-1;s>=0;s--)n=t._markers[s],i&&i.contains(n._latlng)||(t._group._featureGroup.removeLayer(n),n.setOpacity&&n.setOpacity(1))},function(t){for(s=t._childClusters.length-1;s>=0;s--)n=t._childClusters[s],i&&i.contains(n._latlng)||(t._group._featureGroup.removeLayer(n),n.setOpacity&&n.setOpacity(1))})},_recursively:function(t,e,i,n,s){var r,o,a=this._childClusters,h=this._zoom;if(e>h)for(r=a.length-1;r>=0;r--)o=a[r],t.intersects(o._bounds)&&o._recursively(t,e,i,n,s);else if(n&&n(this),s&&this._zoom===i&&s(this),i>h)for(r=a.length-1;r>=0;r--)o=a[r],t.intersects(o._bounds)&&o._recursively(t,e,i,n,s)},_recalculateBounds:function(){var t,e=this._markers,i=this._childClusters;for(this._bounds=new L.LatLngBounds,delete this._wLatLng,t=e.length-1;t>=0;t--)this._expandBounds(e[t]);for(t=i.length-1;t>=0;t--)this._expandBounds(i[t])},_isSingleParent:function(){return this._childClusters.length>0&&this._childClusters[0]._childCount===this._childCount}}),L.DistanceGrid=function(t){this._cellSize=t,this._sqCellSize=t*t,this._grid={},this._objectPoint={}},L.DistanceGrid.prototype={addObject:function(t,e){var i=this._getCoord(e.x),n=this._getCoord(e.y),s=this._grid,r=s[n]=s[n]||{},o=r[i]=r[i]||[],a=L.Util.stamp(t);this._objectPoint[a]=e,o.push(t)},updateObject:function(t,e){this.removeObject(t),this.addObject(t,e)},removeObject:function(t,e){var i,n,s=this._getCoord(e.x),r=this._getCoord(e.y),o=this._grid,a=o[r]=o[r]||{},h=a[s]=a[s]||[];for(delete this._objectPoint[L.Util.stamp(t)],i=0,n=h.length;n>i;i++)if(h[i]===t)return h.splice(i,1),1===n&&delete a[s],!0},eachObject:function(t,e){var i,n,s,r,o,a,h,_=this._grid;for(i in _){o=_[i];for(n in o)for(a=o[n],s=0,r=a.length;r>s;s++)h=t.call(e,a[s]),h&&(s--,r--)}},getNearObject:function(t){var e,i,n,s,r,o,a,h,_=this._getCoord(t.x),u=this._getCoord(t.y),l=this._objectPoint,d=this._sqCellSize,p=null;for(e=u-1;u+1>=e;e++)if(s=this._grid[e])for(i=_-1;_+1>=i;i++)if(r=s[i])for(n=0,o=r.length;o>n;n++)a=r[n],h=this._sqDist(l[L.Util.stamp(a)],t),d>h&&(d=h,p=a);return p},_getCoord:function(t){return Math.floor(t/this._cellSize)},_sqDist:function(t,e){var i=e.x-t.x,n=e.y-t.y;return i*i+n*n}},function(){L.QuickHull={getDistant:function(t,e){var i=e[1].lat-e[0].lat,n=e[0].lng-e[1].lng;return n*(t.lat-e[0].lat)+i*(t.lng-e[0].lng)},findMostDistantPointFromBaseLine:function(t,e){var i,n,s,r=0,o=null,a=[];for(i=e.length-1;i>=0;i--)n=e[i],s=this.getDistant(n,t),s>0&&(a.push(n),s>r&&(r=s,o=n));return{maxPoint:o,newPoints:a}},buildConvexHull:function(t,e){var i=[],n=this.findMostDistantPointFromBaseLine(t,e);return n.maxPoint?(i=i.concat(this.buildConvexHull([t[0],n.maxPoint],n.newPoints)),i=i.concat(this.buildConvexHull([n.maxPoint,t[1]],n.newPoints))):[t[0]]},getConvexHull:function(t){var e,i=!1,n=!1,s=null,r=null;for(e=t.length-1;e>=0;e--){var o=t[e];(i===!1||o.lat>i)&&(s=o,i=o.lat),(n===!1||o.lat<n)&&(r=o,n=o.lat)}var a=[].concat(this.buildConvexHull([r,s],t),this.buildConvexHull([s,r],t));return a}}}(),L.MarkerCluster.include({getConvexHull:function(){var t,e,i=this.getAllChildMarkers(),n=[];for(e=i.length-1;e>=0;e--)t=i[e].getLatLng(),n.push(t);return L.QuickHull.getConvexHull(n)}}),L.MarkerCluster.include({_2PI:2*Math.PI,_circleFootSeparation:25,_circleStartAngle:Math.PI/6,_spiralFootSeparation:28,_spiralLengthStart:11,_spiralLengthFactor:5,_circleSpiralSwitchover:9,spiderfy:function(){if(this._group._spiderfied!==this&&!this._group._inZoomAnimation){var t,e=this.getAllChildMarkers(),i=this._group,n=i._map,s=n.latLngToLayerPoint(this._latlng);this._group._unspiderfy(),this._group._spiderfied=this,e.length>=this._circleSpiralSwitchover?t=this._generatePointsSpiral(e.length,s):(s.y+=10,t=this._generatePointsCircle(e.length,s)),this._animationSpiderfy(e,t)}},unspiderfy:function(t){this._group._inZoomAnimation||(this._animationUnspiderfy(t),this._group._spiderfied=null)},_generatePointsCircle:function(t,e){var i,n,s=this._group.options.spiderfyDistanceMultiplier*this._circleFootSeparation*(2+t),r=s/this._2PI,o=this._2PI/t,a=[];for(a.length=t,i=t-1;i>=0;i--)n=this._circleStartAngle+i*o,a[i]=new L.Point(e.x+r*Math.cos(n),e.y+r*Math.sin(n))._round();return a},_generatePointsSpiral:function(t,e){var i,n=this._group.options.spiderfyDistanceMultiplier*this._spiralLengthStart,s=this._group.options.spiderfyDistanceMultiplier*this._spiralFootSeparation,r=this._group.options.spiderfyDistanceMultiplier*this._spiralLengthFactor,o=0,a=[];for(a.length=t,i=t-1;i>=0;i--)o+=s/n+5e-4*i,a[i]=new L.Point(e.x+n*Math.cos(o),e.y+n*Math.sin(o))._round(),n+=this._2PI*r/o;return a},_noanimationUnspiderfy:function(){var t,e,i=this._group,n=i._map,s=i._featureGroup,r=this.getAllChildMarkers();for(this.setOpacity(1),e=r.length-1;e>=0;e--)t=r[e],s.removeLayer(t),t._preSpiderfyLatlng&&(t.setLatLng(t._preSpiderfyLatlng),delete t._preSpiderfyLatlng),t.setZIndexOffset&&t.setZIndexOffset(0),t._spiderLeg&&(n.removeLayer(t._spiderLeg),delete t._spiderLeg);i._spiderfied=null}}),L.MarkerCluster.include(L.DomUtil.TRANSITION?{SVG_ANIMATION:function(){return e.createElementNS("http://www.w3.org/2000/svg","animate").toString().indexOf("SVGAnimate")>-1}(),_animationSpiderfy:function(t,i){var n,s,r,o,a=this,h=this._group,_=h._map,u=h._featureGroup,l=_.latLngToLayerPoint(this._latlng);for(n=t.length-1;n>=0;n--)s=t[n],s.setOpacity?(s.setZIndexOffset(1e6),s.setOpacity(0),u.addLayer(s),s._setPos(l)):u.addLayer(s);h._forceLayout(),h._animationStart();var d=L.Path.SVG?0:.3,p=L.Path.SVG_NS;for(n=t.length-1;n>=0;n--)if(o=_.layerPointToLatLng(i[n]),s=t[n],s._preSpiderfyLatlng=s._latlng,s.setLatLng(o),s.setOpacity&&s.setOpacity(1),r=new L.Polyline([a._latlng,o],{weight:1.5,color:"#222",opacity:d}),_.addLayer(r),s._spiderLeg=r,L.Path.SVG&&this.SVG_ANIMATION){var c=r._path.getTotalLength();r._path.setAttribute("stroke-dasharray",c+","+c);var m=e.createElementNS(p,"animate");m.setAttribute("attributeName","stroke-dashoffset"),m.setAttribute("begin","indefinite"),m.setAttribute("from",c),m.setAttribute("to",0),m.setAttribute("dur",.25),r._path.appendChild(m),m.beginElement(),m=e.createElementNS(p,"animate"),m.setAttribute("attributeName","stroke-opacity"),m.setAttribute("attributeName","stroke-opacity"),m.setAttribute("begin","indefinite"),m.setAttribute("from",0),m.setAttribute("to",.5),m.setAttribute("dur",.25),r._path.appendChild(m),m.beginElement()}if(a.setOpacity(.3),L.Path.SVG)for(this._group._forceLayout(),n=t.length-1;n>=0;n--)s=t[n]._spiderLeg,s.options.opacity=.5,s._path.setAttribute("stroke-opacity",.5);setTimeout(function(){h._animationEnd(),h.fire("spiderfied")},200)},_animationUnspiderfy:function(t){var e,i,n,s=this._group,r=s._map,o=s._featureGroup,a=t?r._latLngToNewLayerPoint(this._latlng,t.zoom,t.center):r.latLngToLayerPoint(this._latlng),h=this.getAllChildMarkers(),_=L.Path.SVG&&this.SVG_ANIMATION;for(s._animationStart(),this.setOpacity(1),i=h.length-1;i>=0;i--)e=h[i],e._preSpiderfyLatlng&&(e.setLatLng(e._preSpiderfyLatlng),delete e._preSpiderfyLatlng,e.setOpacity?(e._setPos(a),e.setOpacity(0)):o.removeLayer(e),_&&(n=e._spiderLeg._path.childNodes[0],n.setAttribute("to",n.getAttribute("from")),n.setAttribute("from",0),n.beginElement(),n=e._spiderLeg._path.childNodes[1],n.setAttribute("from",.5),n.setAttribute("to",0),n.setAttribute("stroke-opacity",0),n.beginElement(),e._spiderLeg._path.setAttribute("stroke-opacity",0)));setTimeout(function(){var t=0;for(i=h.length-1;i>=0;i--)e=h[i],e._spiderLeg&&t++;for(i=h.length-1;i>=0;i--)e=h[i],e._spiderLeg&&(e.setOpacity&&(e.setOpacity(1),e.setZIndexOffset(0)),t>1&&o.removeLayer(e),r.removeLayer(e._spiderLeg),delete e._spiderLeg);s._animationEnd()},200)}}:{_animationSpiderfy:function(t,e){var i,n,s,r,o=this._group,a=o._map,h=o._featureGroup;for(i=t.length-1;i>=0;i--)r=a.layerPointToLatLng(e[i]),n=t[i],n._preSpiderfyLatlng=n._latlng,n.setLatLng(r),n.setZIndexOffset&&n.setZIndexOffset(1e6),h.addLayer(n),s=new L.Polyline([this._latlng,r],{weight:1.5,color:"#222"}),a.addLayer(s),n._spiderLeg=s;this.setOpacity(.3),o.fire("spiderfied")},_animationUnspiderfy:function(){this._noanimationUnspiderfy()}}),L.MarkerClusterGroup.include({_spiderfied:null,_spiderfierOnAdd:function(){this._map.on("click",this._unspiderfyWrapper,this),this._map.options.zoomAnimation&&this._map.on("zoomstart",this._unspiderfyZoomStart,this),this._map.on("zoomend",this._noanimationUnspiderfy,this),L.Path.SVG&&!L.Browser.touch&&this._map._initPathRoot()},_spiderfierOnRemove:function(){this._map.off("click",this._unspiderfyWrapper,this),this._map.off("zoomstart",this._unspiderfyZoomStart,this),this._map.off("zoomanim",this._unspiderfyZoomAnim,this),this._unspiderfy()},_unspiderfyZoomStart:function(){this._map&&this._map.on("zoomanim",this._unspiderfyZoomAnim,this)},_unspiderfyZoomAnim:function(t){L.DomUtil.hasClass(this._map._mapPane,"leaflet-touching")||(this._map.off("zoomanim",this._unspiderfyZoomAnim,this),this._unspiderfy(t))},_unspiderfyWrapper:function(){this._unspiderfy()},_unspiderfy:function(t){this._spiderfied&&this._spiderfied.unspiderfy(t)},_noanimationUnspiderfy:function(){this._spiderfied&&this._spiderfied._noanimationUnspiderfy()},_unspiderfyLayer:function(t){t._spiderLeg&&(this._featureGroup.removeLayer(t),t.setOpacity(1),t.setZIndexOffset(0),this._map.removeLayer(t._spiderLeg),delete t._spiderLeg)}})}(window,document);
////////////////
            
            var $ = jQuery.noConflict();
            var mapStyles = [{featureType: 'water', elementType: 'all', stylers: [{hue: '#d7ebef'}, {saturation: -5}, {lightness: 54}, {visibility: 'on'}]}, {featureType: 'landscape', elementType: 'all', stylers: [{hue: '#eceae6'}, {saturation: -49}, {lightness: 22}, {visibility: 'on'}]}, {featureType: 'poi.park', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'poi.medical', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -80}, {lightness: -2}, {visibility: 'on'}]}, {featureType: 'poi.school', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -91}, {lightness: -7}, {visibility: 'on'}]}, {featureType: 'landscape.natural', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -71}, {lightness: -18}, {visibility: 'on'}]}, {featureType: 'road.highway', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 60}, {visibility: 'on'}]}, {featureType: 'poi', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'road.arterial', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 37}, {visibility: 'on'}]}, {featureType: 'transit', elementType: 'geometry', stylers: [{hue: '#c8c6c3'}, {saturation: 4}, {lightness: 10}, {visibility: 'on'}]}];


            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            // Google Map - Homepage
            ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            function createHomepageGoogleMap(_latitude, _longitude, _locations, source_path) {
                setMapHeight();
                if (document.getElementById('map') != null) {
                    if (_locations.length > 0) {
                        var data = jQuery.parseJSON(_locations);

                        var map = new google.maps.Map(document.getElementById('map'), {
                            zoom: 14,
                            scrollwheel: false,
                            center: new google.maps.LatLng(_latitude, _longitude),
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            styles: mapStyles
                        });
                        var i;
                        var newMarkers = [];
                        for (i = 0; i < data.length; i++) {

                            var pictureLabel = document.createElement("img");
                            pictureLabel.src = data[i]['type'];
                            pictureLabel.width = '26';
                            pictureLabel.height = '26';

                            var boxText = document.createElement("div");
                            infoboxOptions = {
                                content: boxText,
                                disableAutoPan: false,
                                //maxWidth: 150,
                                pixelOffset: new google.maps.Size(-100, 0),
                                zIndex: null,
                                alignBottom: true,
                                boxClass: "infobox-wrapper",
                                enableEventPropagation: true,
                                closeBoxMargin: "0px 0px -8px 0px",
                                closeBoxURL: source_path + "/img/close-btn.png",
                                infoBoxClearance: new google.maps.Size(1, 1)
                            };
                            var marker = new MarkerWithLabel({
                                position: new google.maps.LatLng(data[i]['lat'], data[i]['lng']),
                                map: map,
                                icon: source_path + '/img/marker.png',
                                labelContent: pictureLabel,
                                labelAnchor: new google.maps.Point(50, 0),
                                labelClass: "marker-style"
                            });
                            newMarkers.push(marker);
                            boxText.innerHTML =
                                    '<div class="infobox-inner">' +
                                    '<a href="' + data[i]['link'] + '">' +
                                    '<div class="infobox-image" style="position: relative">' +
                                    '<img src="' + data[i]['featured-image'] + '">' + '<div><span class="infobox-price">' + data[i]['price'] + '</span></div>' +
                                    '</div>' +
                                    '</a>' +
                                    '<div class="infobox-description">' +
                                    '<div class="infobox-title"><a href="' + data[i]['link'] + '">' + data[i]['title'] + '</a></div>' +
                                    '<div class="infobox-location">' + data[i]['address'] + '</div>' +
                                    '</div>' +
                                    '</div>';
                            //Define the infobox
                            newMarkers[i].infobox = new InfoBox(infoboxOptions);
                            google.maps.event.addListener(marker, 'click', (function (marker, i) {
                                return function () {
                                    for (h = 0; h < newMarkers.length; h++) {
                                        newMarkers[h].infobox.close();
                                    }
                                    newMarkers[i].infobox.open(map, this);
                                }
                            })(marker, i));
                        }
                        var clusterStyles = [
                            {
                                url: source_path + '/img/cluster.png',
                                height: 37,
                                width: 37
                            }
                        ];
//                        var markerCluster = new MarkerClusterer(map, newMarkers, {styles: clusterStyles, maxZoom: 15});
                        $('body').addClass('loaded');
                        setTimeout(function () {
                            $('body').removeClass('has-fullscreen-map');
                        }, 1000);
                        $('#map').removeClass('fade-map');
                    }
                    // Enable Geo Location on button click
                    $('.geo-location').on("click", function () {
                        if (navigator.geolocation) {
                            $('#map').addClass('fade-map');
                            navigator.geolocation.getCurrentPosition(success);
                        } else {
                            error('Geo Location is not supported');
                        }
                    });
                }
            }

            // Function which set marker to the user position
            function success(position) {
                createHomepageGoogleMap(position.coords.latitude, position.coords.longitude, ZonerGlobal.locations, ZonerGlobal.source_path);
            }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Google Map - Property Detail
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            function initMap(lat, lng, pictureLabelSrc, icon_url) {
                var subtractPosition = 0;
                var mapWrapper = $('#property-detail-map.float');

                if (document.documentElement.clientWidth > 1200) {
                    subtractPosition = 0.013;
                }
                if (document.documentElement.clientWidth < 1199) {
                    subtractPosition = 0.006;
                }
                if (document.documentElement.clientWidth < 979) {
                    subtractPosition = 0.001;
                }
                if (document.documentElement.clientWidth < 767) {
                    subtractPosition = 0;
                }

                var mapCenter = new google.maps.LatLng(lat, lng);

                if ($("#property-detail-map").hasClass("float")) {
                    mapCenter = new google.maps.LatLng(lat, lng - subtractPosition);
                    mapWrapper.css('width', mapWrapper.width() + mapWrapper.offset().left)
                }

                var mapOptions = {
                    zoom: 15,
                    center: mapCenter,
                    disableDefaultUI: false,
                    scrollwheel: false,
                    styles: mapStyles
                };

                var mapElement = document.getElementById('property-detail-map');
                var map = new google.maps.Map(mapElement, mapOptions);

                var pictureLabel = document.createElement("img");
                pictureLabel.src = pictureLabelSrc;
                pictureLabel.width = "26";
                pictureLabel.heigth = "26";

                var markerPosition = new google.maps.LatLng(lat, lng);
                var marker = new MarkerWithLabel({
                    position: markerPosition,
                    map: map,
                    icon: icon_url,
                    labelContent: pictureLabel,
                    labelAnchor: new google.maps.Point(50, 0),
                    labelClass: "marker-style"
                });
            }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Google Map - Contact
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            function contactUsMap() {
                var mapCenter = new google.maps.LatLng(_latitude, _longitude);
                var mapOptions = {
                    zoom: 15,
                    center: mapCenter,
                    disableDefaultUI: false,
                    scrollwheel: false,
                    styles: mapStyles
                };
                var mapElement = document.getElementById('contact-map');
                var map = new google.maps.Map(mapElement, mapOptions);

                var marker = new MarkerWithLabel({
                    position: mapCenter,
                    map: map,
                    icon: source_path + '/img/marker.png',
                    //labelContent: pictureLabel,
                    labelAnchor: new google.maps.Point(50, 0),
                    labelClass: "marker-style"
                });
            }

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// OpenStreetMap - Homepage
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            function createHomepageOSM(_latitude, _longitude, _locations, source_path) {
                setMapHeight();
                if (document.getElementById('map') != null) {
                    if (_locations.length > 0) {
                        var data = jQuery.parseJSON(_locations);

                        var map = L.map('map', {
                            center: [_latitude, _longitude],
                            zoom: 14,
                            scrollWheelZoom: false,
                            closeOnClick: true
                        });

                        map.on('popupopen', function (e) {
                            Holder.run({domain: "galleryFrontEnd.holder", use_canvas: true});
                        });

                        L.tileLayer('http://openmapsurfer.uni-hd.de/tiles/roadsg/x={x}&y={y}&z={z}', {
                            //L.tileLayer('http://{s}.tile.openstreetmap.fr/hot/{z}/{x}/{y}.png', {
                            //subdomains: '0123',
                            attribution: 'Imagery from <a href="http://giscience.uni-hd.de/">GIScience Research Group @ University of Heidelberg</a> &mdash; Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>'
                        }).addTo(map);
                        var markers = L.markerClusterGroup({
                            showCoverageOnHover: false
                        });

                        function locateUser() {
                            $('#map').addClass('fade-map');
                            map.locate({setView: true})
                        }

                        function onLocationFound() {
                            $('#map').removeClass('fade-map');
                        }

                        for (var i = 0; i < data.length; i++) {
                            var _icon = L.divIcon({
                                html: '<img width="26px" height="26px" src="' + data[i]['type'] + '">',
                                iconSize: [40, 48],
                                iconAnchor: [20, 48],
                                popupAnchor: [0, -48]
                            });

                            var title = data[i]['title'];
                            var marker = L.marker(new L.LatLng(data[i]['lat'], data[i]['lng']), {
                                title: title,
                                icon: _icon
                            });

                            var fimg = '<img width="100%" data-src="galleryFrontEnd.holder/555x445/auto/text:Property" alt="" />';

                            if (data[i]['featured-image'] != '') {
                                fimg = '<img width="100%" src="' + data[i]['featured-image'] + '">'
                            }

                            marker.bindPopup(
                                    '<div class="property">' +
                                    '<a href="' + data[i]['link'] + '">' +
                                    '<div class="property-image">' +
                                    fimg +
                                    '</div>' +
                                    '<div class="overlay">' +
                                    '<div class="info">' +
                                    '<div class="tag price"> ' + data[i]['price'] + '</div>' +
                                    '<h3>' + data[i]['title'] + '</h3>' +
                                    '<figure>' + data[i]['address'] + '</figure>' +
                                    '</div>' +
                                    '</div>' +
                                    '</a>' +
                                    '</div>'
                                    );
                            markers.addLayer(marker);
                        }

                        map.addLayer(markers);
                        map.on('locationfound', onLocationFound);

                        $('.geo-location').on("click", function () {
                            locateUser();
                        });

                        $('body').addClass('loaded');
                        setTimeout(function () {
                            $('body').removeClass('has-fullscreen-map');
                        }, 1000);

                        $('#map').removeClass('fade-map');

                    }

                }
            }

            function initialize() {
                var mapStyles = [{featureType: 'water', elementType: 'all', stylers: [{hue: '#d7ebef'}, {saturation: -5}, {lightness: 54}, {visibility: 'on'}]}, {featureType: 'landscape', elementType: 'all', stylers: [{hue: '#eceae6'}, {saturation: -49}, {lightness: 22}, {visibility: 'on'}]}, {featureType: 'poi.park', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'poi.medical', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -80}, {lightness: -2}, {visibility: 'on'}]}, {featureType: 'poi.school', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -91}, {lightness: -7}, {visibility: 'on'}]}, {featureType: 'landscape.natural', elementType: 'all', stylers: [{hue: '#c8c6c3'}, {saturation: -71}, {lightness: -18}, {visibility: 'on'}]}, {featureType: 'road.highway', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 60}, {visibility: 'on'}]}, {featureType: 'poi', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -81}, {lightness: 34}, {visibility: 'on'}]}, {featureType: 'road.arterial', elementType: 'all', stylers: [{hue: '#dddbd7'}, {saturation: -92}, {lightness: 37}, {visibility: 'on'}]}, {featureType: 'transit', elementType: 'geometry', stylers: [{hue: '#c8c6c3'}, {saturation: 4}, {lightness: 10}, {visibility: 'on'}]}];
                var mapOptions = {
                    center: new google.maps.LatLng(-23.0004939, -43.3984272),
                    zoom: 14,
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    styles: mapStyles
                };
                var map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);
            }
        </script>
        <script type='text/javascript'>
            /* <![CDATA[ */
            var ZonerGlobal = {
                "ajaxurl": "http:\/\/themes.fruitfulcode.com\/zoner\/wp-admin\/admin-ajax.php",
                "is_mobile": "",
                "is_general_page": "1",
                "source_path": "http:\/\/themes.fruitfulcode.com\/zoner\/wp-content\/themes\/zoner\/includes\/theme\/assets",
                "start_lat": "40.7056308",
                "start_lng": "-73.9780035",
                "locations": "[{\"title\":\"Osiedle domk\\u00f3w szeregowych w Rudzie \\u015al\\u0105skiej\",\"address\":\"Ruda \\u015al\\u0105ska, ruda , 41-706\",\"price\":\"z\u0142 120000\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/osiedle-domk%c3%b3w-szeregowych-w-rudzie-%c5%9bl%c4%85skiej\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/11\\\/DSCN0648-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"4 bedroom detached house for sale\",\"address\":\"coventry, 78 swan lane, cv2 4ga\",\"price\":\"$ 2000\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/4-bedroom-detached-house-for-sale\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/86-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/warehouse.png\"},{\"title\":\"property 1\",\"address\":\"krakow, al. pokoju, 32-300\",\"price\":\"z\u0142 1200\",\"lat\":\"50.059640114744\",\"lng\":\"19.974229864001472\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/property-1\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/PICT0277-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"gdfgsd\",\"address\":\"Konstanz, Salmannsweilergasse, 78462\",\"price\":\"\u20ac 4444\",\"lat\":\"47.661303953800235\",\"lng\":\"9.173752984130829\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/gdfgsd\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/Foto-2-1-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/construction-site.png\"},{\"title\":\"Iglesia Chiquitana en Alquiler\",\"address\":\"Santa Cruz, Por Ahi, 00000\",\"price\":\"$ 805\",\"lat\":\"-22.605648190950884\",\"lng\":\"-58.863388920654245\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/iglesia-chiquitana-en-alquiler\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/DSC00567-Custom-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/condominium.png\"},{\"title\":\"Norm\",\"address\":\"\\u0410\\u043d\\u0430\\u043f\\u0430, \\u0425\\u0443\\u0442\\u043e\\u0440 \\u0417\\u0430\\u0440\\u044f, \\u0443\\u043b\\u0438\\u0446\\u0430 \\u0421\\u043e\\u0432\\u0435\\u0442\\u0441\\u043a\\u0430\\u044f 5445, 353415\",\"price\":\"\u0440\u0443\u0431. 15000\",\"lat\":\"40.69996984429645\",\"lng\":\"-73.98967647363281\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/norm\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/11-430x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/condominium.png\"},{\"title\":\"Lost\",\"address\":\"New York, 24 east 84th street, 10028\",\"price\":\"$ 4000\",\"lat\":\"40.775622525304456\",\"lng\":\"-73.95327680799562\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/lost\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/IMG_2401-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"Ulo ndi OCha\",\"address\":\"Owerri, Owerri, 234\",\"price\":\"\u20a6 234000\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/ulo-ndi-ocha\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/jh-interstitial-ssl-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/condominium.png\"},{\"title\":\"3 BHK, 1360 Sq-ft Flat For Sale\",\"address\":\"Navi Mumbai, CBD Bela pur, Navi Mumbai, 410210\",\"price\":\"Rs. 620000\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/3-bhk-1360-sq-ft-flat-for-sale\\\/\",\"featured-image\":\"\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/warehouse.png\"},{\"title\":\"HABITACI\\u00d3N PRINCIPAL (Botafoc)\",\"address\":\"ibiza, 49 Via P\\u00fanica, Ibiza, Balearic Islands, Espa\\u00f1a , 07800\",\"price\":\"\u20ac 150\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/se-alquila-habitaci%c3%b3n-principal-botafoc\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/02-440x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"ThemeStarz Property\",\"address\":\"Viena, Main Street 3, 123\",\"price\":\"$ 4580\",\"lat\":\"40.702442504818606\",\"lng\":\"-73.98418330957031\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/themestarz-property\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/property-02.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/cottage.png\"},{\"title\":\"999 Eugen Street\",\"address\":\"New York, 999 Eugen Street\",\"price\":\"\u20ac 100000\",\"lat\":\"40.70029519960936\",\"lng\":\"-73.9939787368927\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/999-eugen-street\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/property-detail-03-440x220.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/themes\\\/zoner\\\/includes\\\/theme\\\/assets\\\/img\\\/empty.png\"},{\"title\":\"9\\\/11 Memorial and Museum\",\"address\":\"New York, 180 Greenwich Street New York\",\"price\":\"$ 285000\",\"lat\":\"40.706089120055346\",\"lng\":\"-74.00196838000477\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/911-memorial-and-museum\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/10\\\/911-memorial-07-440x294.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/construction-site.png\"},{\"title\":\"4068 Diamond Street\",\"address\":\"New York, 110 Diamond Street, 10002\",\"price\":\"$ 35000\",\"lat\":\"40.69310447668314\",\"lng\":\"-73.98620033074951\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/4068-diamond-street\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/the-interior-of-the-428657_440.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/warehouse.png\"},{\"title\":\"1028 Henery Street\",\"address\":\"New York, 110 Bridge St, 10002\",\"price\":\"$ 28000\",\"lat\":\"40.69756216559081\",\"lng\":\"-73.99306678582764\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/1028-henery-street\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/house-406969_440.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"3398 Lodgeville Road\",\"address\":\"New York, 110 Bridge St, 10002\",\"price\":\"$ 28000\",\"lat\":\"40.70172674410699\",\"lng\":\"-73.98469829370117\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/3398-lodgeville-road\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/apartment-185779_1920-440x293.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"17 St George\u2019s Square\",\"address\":\"London, 17 St George\\\\'s Square, SW1V\",\"price\":\"$ 160000\",\"lat\":\"51.489215392503425\",\"lng\":\"-0.13537311364746074\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/17-st-georges-square\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_13-259x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/warehouse.png\"},{\"title\":\"34 Queen Anne\u2019s Gate\",\"address\":\"London, 34 Queen Anne\\\\'s Gate, SW1H\",\"price\":\"$ 500000\",\"lat\":\"51.500697618909946\",\"lng\":\"-0.13364577104186992\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/34-queen-annes-gate\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_12.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/condominium.png\"},{\"title\":\"County Hall\",\"address\":\"London, Lambeth, SE1\",\"price\":\"$ 600000\",\"lat\":\"51.50167938535641\",\"lng\":\"-0.11952662278758908\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/county-hall\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_11.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/cottage.png\"},{\"title\":\"Brittany Point\",\"address\":\"London, Lambeth, SE11\",\"price\":\"$ 450\",\"lat\":\"51.48972978331253\",\"lng\":\"-0.11159801293945293\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/brittany-point\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_91.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/single-family.png\"},{\"title\":\"30 Warner St\",\"address\":\"London, 30 Warner St, EC1R 5EX\",\"price\":\"$ 97000\",\"lat\":\"51.5233530018723\",\"lng\":\"-0.11047148515319805\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/30-warner-st\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_10.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"75 High Holborn\",\"address\":\"London, 75 High Holborn, WC1V 6LS\",\"price\":\"$ 80000\",\"lat\":\"51.517905521410455\",\"lng\":\"-0.11636161614990215\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/75-high-holborn\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_9.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/cottage.png\"},{\"title\":\"7 Arundel St\",\"address\":\"London, 7 Arundel St, WC2R 3DA\",\"price\":\"$ 90001\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/7-arundel-st\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_8.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/cottage.png\"},{\"title\":\"10 Kingsway\",\"address\":\"London, 10 Kingsway\",\"price\":\"$ 50000\",\"lat\":\"51.51375271507068\",\"lng\":\"-0.11754178811645488\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/10-kingsway\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_7.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/vineyard.png\"},{\"title\":\"1 Catton St\",\"address\":\"London, 1 Catton St, WC1R 4AB\",\"price\":\"$ 89999\",\"lat\":\"51.517832082786384\",\"lng\":\"-0.11992358972167949\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/1-catton-st\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_6-289x330.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/condominium.png\"},{\"title\":\"Pushkin House\",\"address\":\"London, 5A Bloomsbury Square, WC1A 2TA\",\"price\":\"$ 980\",\"lat\":\"40.7056308\",\"lng\":\"-73.9780035\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/pushkin-house\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_5.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/single-family.png\"},{\"title\":\"1234 High Holborn\",\"address\":\"London, 1234 High Holborn, WC1A 1NU\",\"price\":\"$ 90000\",\"lat\":\"51.51657693163256\",\"lng\":\"-0.12420975972747783\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/1234-high-holborn\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_4.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/warehouse.png\"},{\"title\":\"37 Great Russell St\",\"address\":\"London, 37 Great Russell St, WC1B\",\"price\":\"$ 58000\",\"lat\":\"51.517792025305276\",\"lng\":\"-0.1272245626602171\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/37-great-russell-st\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_3.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/cottage.png\"},{\"title\":\"159 Charing Cross Rd\",\"address\":\"London, 159 Charing Cross Rd, WC2H\",\"price\":\"$ 76000\",\"lat\":\"51.51598606392943\",\"lng\":\"-0.13284110833751583\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/159-charing-cross-rd\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_2.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"St Floor Wingate House,\",\"address\":\"London, 93-107 Shaftesbury Ave, W1D 5DY\",\"price\":\"$ 100000\",\"lat\":\"51.51271111582853\",\"lng\":\"-0.13048076440429668\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/st-floor-wingate-house\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_1.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/apartment.png\"},{\"title\":\"987 Cantebury Drive\",\"address\":\"Paris, Golden Valley, MN 55427, 69001\",\"price\":\"$ 13333\",\"lat\":\"40.703158257838666\",\"lng\":\"-73.98276710321045\",\"link\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/property\\\/987-cantebury-drive-2\\\/\",\"featured-image\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/09\\\/thumbnail_8.jpg\",\"type\":\"http:\\\/\\\/themes.fruitfulcode.com\\\/zoner\\\/wp-content\\\/uploads\\\/2014\\\/07\\\/construction-site.png\"}]", "icon_marker": "http:\/\/themes.fruitfulcode.com\/zoner\/wp-content\/themes\/zoner\/includes\/admin\/zoner-framework\/..\/zoner-options\/patterns\/images\/icons\/marker.png",
                "min_price": "150",
                "max_price": "620000",
                "header_variations": "1",
                "zoner_ajax_nonce": "6a63b6a3a9",
                "zoner_message_send_text": "Thank you. Your message has been sent successfully.",
                "zoner_message_faq_text": "Thank you for your vote."};
            /* ]]> */
        </script>
    </head>
    <body onload="initialize()">
        <!-- Map -->
        <div id="map" class="has-parallax"></div>
        <!-- end Map -->
    </body>
    <script>

        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// jQuery
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        var $ = jQuery.noConflict();

        var ajaxurl = ZonerGlobal.ajaxurl;
        var is_general_page = ZonerGlobal.is_general_page;

        var start_lat = ZonerGlobal.start_lat;
        var start_lng = ZonerGlobal.start_lng;
        var locations = ZonerGlobal.locations;
        var source_path = ZonerGlobal.source_path;
        var zoner_ajax_nonce = ZonerGlobal.zoner_ajax_nonce;


        var min_price = parseInt(ZonerGlobal.min_price);
        var max_price = parseInt(ZonerGlobal.max_price);
        var header_variations = ZonerGlobal.header_variations;

        var zoner_message_send_text = ZonerGlobal.zoner_message_send_text;
        var zoner_message_faq_text = ZonerGlobal.zoner_message_faq_text;

        $(document).ready(function ($) {
            "use strict";

            if ($('#searchform').length > 0) {
                $('#searchform button').on('click', function () {
                    $('#searchform').submit();
                });
            }

            /*Change Currency*/

            if ($('#submit-currency').length > 0) {
                $('#submit-currency').on('change', function () {
                    var curr_val = $('#submit-currency option:selected').text();
                    var pos_str = curr_val.indexOf(' ');

                    if ($('#submit-price').length > 0) {
                        $('#submit-price').parent().find('span.input-group-addon').html(curr_val.substr(0, pos_str));
                    }
                });
            }


            /*Faq's votes*/
            if ($('.answer-votes').length > 0) {
                $('.answer-votes a.faq-help-yes').on('click', function () {
                    var elem = $(this);
                    var faq_id = elem.data('faqid');
                    var data = {action: 'zoner_helpful_faq',
                        faq_id: faq_id,
                        choose: 'yes'};

                    $.post(ajaxurl, data, function (response) {
                        $.jGrowl(zoner_message_faq_text, {position: "top-right"});
                        elem.parent().fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });
                    return false;
                });


                $('.answer-votes a.faq-help-no').on('click', function () {
                    var elem = $(this);
                    var faq_id = elem.data('faqid');
                    var data = {action: 'zoner_helpful_faq',
                        faq_id: faq_id,
                        choose: 'no'};

                    $.post(ajaxurl, data, function (response) {
                        $.jGrowl(zoner_message_faq_text, {position: "top-right"});
                        elem.parent().fadeOut('slow', function () {
                            $(this).remove();
                        });
                    });

                    return false;
                });
            }

            if ($('.blog-post .meta .tags').length > 0) {
                $('.blog-post .meta .tags').each(function () {

                    if ($(this).outerHeight() > 26) {
                        $(this).css({'margin-top': '10px'});
                        $(this).css({'margin-bottom': '10px'});
                        $(this).find('a').css({'margin-bottom': '10px'});
                    }
                });
            }

            /*Delete agency*/
            if ($('.delete-agency').length > 0) {

                var agency_id = '';

                $('.delete-agency').on('click', function () {
                    $("#lmDeleteAgencyWnd").modal('show');
                    agency_id = $(this).data('agencyid');
                    return false;
                });


                if ($('#deleteAgencyAct').length > 0) {
                    $('#deleteAgencyAct').on('click', function () {
                        var data = {action: 'delete_agency_act', agnecy_id: agency_id, security: zoner_ajax_nonce};
                        $.post(ajaxurl, data, function (response) {
                            $("#lmDeleteAgencyWnd").modal('hide');
                            location.reload();
                        });
                        return false;
                    });
                }
            }

            /*Delete Property*/
            if ($('.delete-property').length > 0) {

                var property_id = '';

                $('.delete-property').on('click', function () {
                    $("#lmDeletePropertyWnd").modal('show');
                    property_id = $(this).data('propertyid');
                    return false;
                });


                if ($('#deletePropertyAct').length > 0) {
                    $('#deletePropertyAct').on('click', function () {
                        var data = {action: 'delete_property_act', property_id: property_id, security: zoner_ajax_nonce};
                        $.post(ajaxurl, data, function (response) {
                            $("#lmDeletePropertyWnd").modal('hide');
                            location.reload();
                        });
                        return false;
                    });
                }
            }

            /*Delete Property*/
            if ($('.delete-invite-agent').length > 0) {
                var invite_id = '';

                $('.delete-invite-agent').on('click', function () {
                    invite_id = $(this).data('inviteid');
                    $("#lmDeleteinviteWnd").modal('show');
                    return false;
                });


                if ($('#deleteInviteAgentAct').length > 0) {
                    $('#deleteInviteAgentAct').on('click', function () {
                        var data = {action: 'delete_invite_agent_act', invite_id: invite_id, security: zoner_ajax_nonce};
                        $.post(ajaxurl, data, function (response) {
                            $("#deleteInviteAgentAct").modal('hide');
                            location.reload();
                        });
                        return false;
                    });
                }
            }


            /*Profile - remove profile avatar*/
            $('#profile .avatar-wrapper .remove-btn').on('click', function () {
                $(this).parent().remove();
                $('#form-account-avatar').val('');
                $('#form-account-avatar-id').val('');

                return false;
            });

//            Holder.add_theme("galleryFrontEnd", {foreground: "#CDCDCD", background: "#CDCDCD", size: 15}).run({
//                domain: "galleryFrontEnd.holder",
//                use_canvas: true
//            })

            function readURL(input, img) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(img).attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }


            if ($('.file-inputs').length > 0) {
                $('.file-inputs').bootstrapFileInput();
            }

            $('#form-account-avatar-file').change(function () {
                readURL(this, '#avatar-image');
            });
            $('#property-featured-image').change(function () {
                readURL(this, '#prop-featured-image');
            });


            $('#agency-featured-image-file').change(function () {
                readURL(this, '#agency-featured-image');
            });

            $('#agency-logo-image-file').change(function () {
                readURL(this, '#agency-logo-image');
            });


            if ($('.remove-agency-featured').length > 0) {
                $('.remove-agency-featured').on('click', function () {

                    $('#agency-featured-image-exists').val('');
                    $(this).parent().find('img').remove();
                    $(this).parent().append('<img id="agency-featured-image" class="img-responsive" data-src="galleryFrontEnd.holder/200x200/auto/text:Featured"/>');

                    Holder.run({domain: "galleryFrontEnd.holder", use_canvas: true});
                    return false;
                });

            }

            if ($('#form-account-password').length > 0) {
                $('#form-account-password').validate({});

                $('#form-account-password-current').rules("add", {
                    required: true,
                    minlength: 6,
                    remote: {
                        url: ajaxurl,
                        type: "post",
                        data: {
                            action: 'zoner_check_user_password'
                        }
                    }
                });

                $("#form-account-password-new").rules("add", {
                    minlength: 6,
                    required: true,
                });

                $("#form-account-password-confirm-new").rules("add", {
                    required: true,
                    minlength: 6,
                    equalTo: "#form-account-password-new"
                });
            }


            if ($('.remove-agency-logo').length > 0) {
                $('.remove-agency-logo').on('click', function () {

                    $('#agency-logo-image-exists').val('');
                    $(this).parent().find('img').remove();
                    $(this).parent().append('<img id="agency-logo-image" class="img-responsive" data-src="galleryFrontEnd.holder/200x200/auto/text:Logo"/>');

                    Holder.run({domain: "galleryFrontEnd.holder", use_canvas: true});
                    return false;
                });

            }


            $('.zoner-property-sort').on('change', function () {
                $(this).closest('form').submit();
            });


            if ($('.remove-prop-featured').length > 0) {
                $('.remove-prop-featured').on('click', function () {

                    $('#prop-featured-image-exists').val('');
                    $(this).parent().find('img').remove();
                    $(this).parent().append('<img width="100%"  id="prop-featured-image" class="img-responsive" src="galleryFrontEnd.holder/410x410/auto/text:Featured"/>');

                    Holder.run({domain: "galleryFrontEnd.holder", use_canvas: true});
                    return false;
                });

            }

            equalHeight('.equal-height');

            $('.nav > li > ul li > ul').css('left', $('.nav > li > ul').width());

            var navigationLi = $('.nav > li');
            navigationLi.hover(function () {
                if ($('body').hasClass('navigation-fixed-bottom')) {
                    if ($(window).width() > 768) {
                        var spaceUnderNavigation = $(window).height() - ($(this).offset().top - $(window).scrollTop());
                        if (spaceUnderNavigation < $(this).children('.child-navigation').height()) {
                            $(this).children('.child-navigation').addClass('position-bottom');
                        } else {
                            $(this).children('.child-navigation').removeClass('position-bottom');
                        }
                    }
                }
            });

            setNavigationPosition();

//            $('.tool-tip').tooltip();

            var select = $('select');
            if (select.length > 0) {
                select.selectpicker();
            }

            var bootstrapSelect = $('.bootstrap-select');
            var dropDownMenu = $('.dropdown-menu');

            bootstrapSelect.on('shown.bs.dropdown', function () {
                dropDownMenu.removeClass('animation-fade-out');
                dropDownMenu.addClass('animation-fade-in');
            });

            bootstrapSelect.on('hide.bs.dropdown', function () {
                dropDownMenu.removeClass('animation-fade-in');
                dropDownMenu.addClass('animation-fade-out');
            });

            bootstrapSelect.on('hidden.bs.dropdown', function () {
                var _this = $(this);
                $(_this).addClass('open');
                setTimeout(function () {
                    $(_this).removeClass('open');
                }, 100);
            });

            select.change(function () {
                if ($(this).val() != '') {
                    $('.form-search .bootstrap-select.open').addClass('selected-option-check');
                } else {
                    $('.form-search  .bootstrap-select.open').removeClass('selected-option-check');
                }
            });

//  Contact form

            $("#form-contact-submit").bind("click", function (event) {
                $("#form-contact").validate({
                    submitHandler: function () {
                        $.post("assets/php/contact.php", $("#form-contact").serialize(), function (response) {
                            $('#form-status').html(response);
                            $('#form-contact-submit').attr('disabled', 'true');
                        });
                        return false;
                    }
                });
            });

            if ($(".mail-form-sending").length > 0) {
                $(".mail-form-sending").validate({
                    submitHandler: function (form) {
                        var data = '';
                        data = {action: 'zoner_mail_form_sending', formData: $(form).serialize()};
                        $.post(ajaxurl, data, function (response) {
                            if (response > 0) {
                                $.jGrowl(zoner_message_send_text, {position: "top-right"});
                                $(form).find('input, textarea').val('');
                            }
                        });
                        return false;
                    }
                });

            }


            if ($('.tool-tip-info').length > 0) {
                $('.tool-tip-info').tooltip({
                    placement: 'bottom'
                });
            }



//  Fit videos width and height

            if ($(".video").length > 0) {
                $(".video").fitVids();
            }

//  Price slider
            var $priceSlider = $(".price-input");
            if ($priceSlider.length > 0) {
                $priceSlider.each(function () {
                    $(this).slider({
                        from: 0,
                        to: max_price,
                        step: 1000,
                        smooth: true,
                        round: 0,
                        heterogeneity: ['50/500000'],
                        format: {locale: 'en'}
                    });
                });

            }

//  Parallax scrolling and fixed header after scroll

            $('#map .marker-style').css('opacity', '.5 !important');
            $('#map .marker-style').css('bakground-color', 'red');

            $(window).scroll(function () {
                var scrollAmount = $(window).scrollTop() / 1.5;
                scrollAmount = Math.round(scrollAmount);
                if ($("body").hasClass("navigation-fixed-bottom")) {
                    if ($(window).scrollTop() > $(window).height() - $('.navigation').height()) {
                        $('.navigation').addClass('navigation-fix-to-top');
                    } else {
                        $('.navigation').removeClass('navigation-fix-to-top');
                    }
                }

                if ($(window).width() > 768) {
                    if ($('#map').hasClass('has-parallax')) {
                        $('#map .gm-style').css('margin-top', scrollAmount + 'px');
                        $('#map .leaflet-map-pane').css('margin-top', scrollAmount + 'px');
                    }
                    if ($('#slider').hasClass('has-parallax')) {
                        $(".homepage-slider").css('top', scrollAmount + 'px');
                    }
                }
            });


//  Smooth Navigation Scrolling

            $('.navigation .nav a[href^="#"], a[href^="#"].roll').on('click', function (e) {
                e.preventDefault();
                var target = this.hash,
                        $target = $(target);
                if ($(window).width() > 768) {
                    $('html, body').stop().animate({
                        'scrollTop': $target.offset().top - $('.navigation').height()
                    }, 2000)
                } else {
                    $('html, body').stop().animate({
                        'scrollTop': $target.offset().top
                    }, 2000)
                }
            });

//  Rating

            var ratingOverall = $('.rating-overall');
            if (ratingOverall.length > 0) {
                ratingOverall.raty({
                    path: source_path + '/img',
                    readOnly: true,
                    half: true, // Enables half star selection.
                    halfShow: true,
                    score: function () {
                        return $(this).attr('data-score');
                    }
                });
            }

            var ratingIndividual = $('.rating-individual');
            if (ratingIndividual.length > 0) {
                ratingIndividual.raty({
                    path: source_path + '/img',
                    readOnly: true,
                    score: function () {
                        return $(this).attr('data-score');
                    }
                });
            }

            var ratingUser = $('.rating-user');
            if (ratingUser.length > 0) {

                $('.rating-user .inner').raty({
                    path: source_path + '/img',
                    starOff: 'big-star-off.png',
                    starOn: 'big-star-on.png',
                    width: 150,
                    //target : '#hint',
                    targetType: 'number',
                    targetFormat: 'Rating: {score}',
                    click: function (score, evt) {
                        showRatingForm();
                        if ($('#form-rating').length > 0) {
                            $('#form-rating input#form-rating-score').val(score);

                        }
                    }
                });
            }

//  Agent State

            $('#agent-switch').on('ifClicked', function (event) {
                agentState();
            });

            $('#create-account-user').on('ifClicked', function (event) {
                $('#agent-switch').data('agent-state', '');
                agentState();
            });

// Set Bookmark button attribute

            var bookmarkButton = $(".bookmark");

            if (bookmarkButton.data('bookmark-state') == 'empty') {
                bookmarkButton.removeClass('bookmark-added');
            } else if (bookmarkButton.data('bookmark-state') == 'added') {
                bookmarkButton.addClass('bookmark-added');
            }

            bookmarkButton.on("click", function () {
                var is_choose = 0;
                var property_id = bookmarkButton.data('propertyid');

                if (bookmarkButton.data('bookmark-state') == 'empty') {
                    bookmarkButton.data('bookmark-state', 'added');
                    bookmarkButton.addClass('bookmark-added');
                    is_choose = 1;
                } else if (bookmarkButton.data('bookmark-state') == 'added') {
                    bookmarkButton.data('bookmark-state', 'empty');
                    bookmarkButton.removeClass('bookmark-added');
                    is_choose = 0;
                }

                var data = {action: 'add_user_bookmark', property_id: property_id, is_choose: is_choose};

                $.post(ajaxurl, data, function (response) {
                    /*after insert*/
                });

                return false;
            });

            if ($('body').hasClass('navigation-fixed-bottom')) {
                var admin_bar_h = 0;
                if ($('#wpadminbar').length > 0) {
                    admin_bar_h = $('#wpadminbar').outerHeight();
                }
                $('#page-content').css('padding-top', $('.navigation').height() - admin_bar_h);
            }


//  Masonry grid listing

            if ($('.property').hasClass('masonry')) {
                var container = $('.grid');

                container.imagesLoaded(function () {
                    container.masonry({
                        gutter: 15,
                        itemSelector: '.masonry'
                    });
                });

                if ($(window).width() > 991) {
                    $('.masonry').hover(function () {
                        $('.masonry').each(function () {
                            $('.masonry').addClass('masonry-hide-other');
                            $(this).removeClass('masonry-show');
                        });
                        $(this).addClass('masonry-show');
                    }, function () {
                        $('.masonry').each(function () {
                            $('.masonry').removeClass('masonry-hide-other');
                        });
                    }
                    );

                    var config = {
                        after: '0s',
                        enter: 'bottom',
                        move: '20px',
                        over: '.5s',
                        easing: 'ease-out',
                        viewportFactor: 0.33,
                        reset: false,
                        init: true
                    };

                    window.scrollReveal = new scrollReveal(config);
                }
            }

//  Magnific Popup

            var imagePopup = $('.image-popup');
            if (imagePopup.length > 0) {
                imagePopup.magnificPopup({
                    type: 'image',
                    removalDelay: 300,
                    mainClass: 'mfp-fade',
                    overflowY: 'scroll'
                });
            }

            if ($('.zoner-gallery-shortcode').length > 0) {

                $('.zoner-gallery-shortcode').each(function () {

                    $(this).magnificPopup({
                        delegate: 'a.thumbnail',
                        type: 'image',
                        removalDelay: 300,
                        mainClass: 'mfp-fade',
                        overflowY: 'scroll',
                        gallery: {
                            enabled: true
                        }
                    });
                });


            }

//  iCheck

            if ($('.checkbox').length > 0) {
                $('input').iCheck();
            }

            if ($('.radio').length > 0) {
                $('input').iCheck();
            }

//  Pricing Tables in Submit page

            if ($('.submit-pricing').length > 0) {
                $('.btn').click(function () {
                    $('.submit-pricing .buttons td').each(function () {
                        $(this).removeClass('package-selected');
                    });
                    $(this).parent().css('opacity', '1');
                    $(this).parent().addClass('package-selected');

                }
                );
            }

//Build header map params
            if ($('#map').length > 0) {
                if (header_variations <= 5) {
                    createHomepageGoogleMap(start_lat, start_lng, locations, source_path);
                } else if ((header_variations > 5) && (header_variations <= 10)) {
                    createHomepageOSM(start_lat, start_lng, locations, source_path);
                }
            }

//Centered Search box
            centerSearchBox();



        });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// On RESIZE
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $(window).on('resize', function () {
            setNavigationPosition();
            setCarouselWidth();
            equalHeight('.equal-height');
            centerSlider();

            drawFooterThumbnails();
        });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// On LOAD
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        $(window).load(function () {

//  Show Search Box on Map

            $('.search-box.map').addClass('show-search-box');

//  Show All button

            showAllButton();

//  Draw thumbnails in the footer

            drawFooterThumbnails();

//  Show counter after appear

            if ($('.number').length > 0) {
                $('.number').each(function () {
                    $(this).waypoint(
                            function () {
                                initCounter($(this));
                            }, {
                        offset: '100%',
                        triggerOnce: true
                    });
                });
            }

            agentState();

//  Owl Carousel

            // Disable click when dragging
            function disableClick() {
                $('.owl-carousel .property').css('pointer-events', 'none');
            }
            // Enable click after dragging
            function enableClick() {
                $('.owl-carousel .property').css('pointer-events', 'auto');
            }

            if ($('.owl-carousel').length > 0) {
                if ($('.carousel-full-width').length > 0) {
                    setCarouselWidth();
                }

                $(".featured-properties-carousel").owlCarousel({
                    items: 5,
                    itemsDesktop: [1700, 3],
                    responsiveBaseWidth: ".featured-properties-carousel",
                    pagination: false,
                    startDragging: disableClick,
                    beforeMove: enableClick
                });

                $(".testimonials-carousel").owlCarousel({
                    items: 1,
                    responsiveBaseWidth: ".testimonial",
                    pagination: true
                });

                $(".property-carousel").owlCarousel({
                    items: 1,
                    responsiveBaseWidth: ".property-slide",
                    pagination: false,
                    autoHeight: true,
                    navigation: true,
                    navigationText: ["", ""],
                    startDragging: disableClick,
                    beforeMove: enableClick
                });

                $(".homepage-slider").owlCarousel({
                    autoPlay: 10000,
                    navigation: true,
                    mouseDrag: false,
                    items: 1,
                    responsiveBaseWidth: ".slide",
                    pagination: false,
                    transitionStyle: 'fade',
                    navigationText: ["", ""],
                    afterInit: sliderLoaded,
                    afterAction: animateDescription,
                    startDragging: animateDescription
                });
            }

            function sliderLoaded() {
                $('#slider').removeClass('loading');
                document.getElementById("loading-icon").remove();
                centerSlider();
            }

            function animateDescription() {
                var $description = $(".slide .overlay .info");
                $description.addClass('animate-description-out');
                $description.removeClass('animate-description-in');
                setTimeout(function () {
                    $description.addClass('animate-description-in');
                }, 400);
            }


        });

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Functions
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Mobile Slider

        function centerSlider() {
            if ($(window).width() < 979) {
                var $navigation = $('.navigation');
                $('#slider .slide').height($(window).height() - $navigation.height());
                $('#slider').height($(window).height() - $navigation.height());

            }
            var imageWidth = $('#slider .slide img').width();
            var viewPortWidth = $(window).width();
            var centerImage = (imageWidth / 2) - (viewPortWidth / 2);
            $('#slider .slide img').css('left', -centerImage);
        }

// Set height of the map

        function setMapHeight() {
            var $body = $('body');
            if ($body.hasClass('has-fullscreen-map')) {
                $('#map').height($(window).height() - $('.navigation').height());
            }
            if ($body.hasClass('has-fullscreen-map')) {
                $(window).on('resize', function () {
                    $('#map').height($(window).height() - $('.navigation').height());
                    var mapHeight = $('#map').height();
                    var contentHeight = $('.search-box').height();
                    var top;
                    top = (mapHeight / 2) - (contentHeight / 2);
                    $('.search-box-wrapper').css('top', top);
                });
            }
            if ($(window).width() < 768) {
                $('#map').height($(window).height() - $('.navigation').height());
            }
        }

        function setNavigationPosition() {
            $('.nav > li').each(function () {
                if ($(this).hasClass('has-child')) {
                    var fullNavigationWidth = $(this).children('.child-navigation').width() + $(this).children('.child-navigation').children('li').children('.child-navigation').width();
                    if (($(this).children('.child-navigation').offset().left + fullNavigationWidth) > $(window).width()) {
                        $(this).children('.child-navigation').addClass('navigation-to-left');
                    }
                }
            });
        }

// Agent state - Fired when user change the state if he is agent or doesn't

        function agentState() {
            var _originalHeight = $('#agency .form-group').height();
            var $agentSwitch = $('#agent-switch');
            var $agency = $('#agency');

            if ($agentSwitch.data('agent-state') == 'is-agent') {
                $agentSwitch.iCheck('check');
                $agency.removeClass('disabled');
                $agency.addClass('enabled');
                $agentSwitch.data('agent-state', '');
            } else {
                $agentSwitch.data('agent-state', 'is-agent');
                $agency.removeClass('enabled');
                $agency.addClass('disabled');
            }
        }

        function initCounter(elem) {
            elem.countTo({
                speed: 3000,
                refreshInterval: 50
            });
        }

        function showAllButton() {

            var rowsToShow = 2; // number of collapsed rows to show
            var $layoutExpandable = $('.layout-expandable');
            var layoutHeightOriginal = $layoutExpandable.height();

            $layoutExpandable.height($('.layout-expandable .row').height() * rowsToShow - 5);

            $('.show-all').on("click", function () {
                if ($layoutExpandable.hasClass('layout-expanded')) {
                    $layoutExpandable.height($('.layout-expandable .row').height() * rowsToShow - 5);
                    $layoutExpandable.removeClass('layout-expanded');
                    $('.show-all').removeClass('layout-expanded');
                } else {
                    $layoutExpandable.height(layoutHeightOriginal);
                    $layoutExpandable.addClass('layout-expanded');
                    $('.show-all').addClass('layout-expanded');
                }
            });

        }

//  Center Search box Vertically

        function centerSearchBox() {
            var $searchBox = $('.search-box-wrapper');
            var $navigation = $('.navigation');
            var positionFromBottom = 20;
            var admin_bar_h = 0;
            if ($('#wpadminbar').length > 0) {
                admin_bar_h = $('#wpadminbar').outerHeight();
            }

            if ($('body').hasClass('navigation-fixed-top')) {
                $('#map, #slider').css('margin-top', $navigation.height() - admin_bar_h);
                $searchBox.css('z-index', 98);
            } else {
                $('.leaflet-map-pane').css('top', -50);
                $(".homepage-slider").css('margin-top', -$('.navigation header').height());
            }
            if ($(window).width() > 768) {
                $('#slider .slide .overlay').css('margin-bottom', $navigation.height());
                $('#map, #slider').each(function () {
                    if (!$('body').hasClass('horizontal-search-float')) {
                        var mapHeight = $(this).height();
                        var contentHeight = $('.search-box').height();
                        var top;
                        if ($('body').hasClass('has-fullscreen-map')) {
                            top = (mapHeight / 2) - (contentHeight / 2);
                        }
                        else {
                            top = (mapHeight / 2) - (contentHeight / 2) + $('.navigation').height();
                        }
                        $('.search-box-wrapper').css('top', top);
                    } else {
                        $searchBox.css('top', $(this).height() + $navigation.height() - $searchBox.height() - positionFromBottom);
                        $('#slider .slide .overlay').css('margin-bottom', $navigation.height() + $searchBox.height() + positionFromBottom);
                        if ($('body').hasClass('has-fullscreen-map')) {
                            $('.search-box-wrapper').css('top', $(this).height() - $('.navigation').height());
                        }
                    }
                });
            }
        }

// Set Owl Carousel width

        function setCarouselWidth() {
            $('.carousel-full-width').css('width', $(window).width());
        }

// Show rating form

        function showRatingForm() {
            $('.rating-form').css('height', $('.rating-form form').height() + 85 + 'px');
        }

//  Equal heights

        function equalHeight(container) {

            var currentTallest = 0,
                    currentRowStart = 0,
                    rowDivs = new Array(),
                    $el,
                    topPosition = 0;
            $(container).each(function () {

                $el = $(this);
                $($el).height('auto');
                topPostion = $el.position().top;

                if (currentRowStart != topPostion) {
                    for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                        rowDivs[currentDiv].height(currentTallest);
                    }
                    rowDivs.length = 0; // empty the array
                    currentRowStart = topPostion;
                    currentTallest = $el.height();
                    rowDivs.push($el);
                } else {
                    rowDivs.push($el);
                    currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
                }
                for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                    rowDivs[currentDiv].height(currentTallest);
                }
            });
        }

//  Creating property thumbnails in the footer

        function drawFooterThumbnails() {
            var thumbnailsPerRow = 1;
            var count = 1;
            // Create thumbnail function
            function createThumbnail() {
                var $thumbnail = $('.footer-thumbnails .property-thumbnail');
                $thumbnail.each(function () {
                    $(this).css('width', 100 / thumbnailsPerRow + '%');
                    $(this).find('img').show();

                    count++;
                });
            }

            if ($(window).width() < 768) {
                thumbnailsPerRow = 5;
                createThumbnail();
            } else if ($(window).width() >= 768 && $(window).width() < 1199) {
                thumbnailsPerRow = 10;
                createThumbnail();
            } else if ($(window).width() >= 1200) {
                thumbnailsPerRow = 20;
                createThumbnail();
            }

        }
    </script>
</html>	