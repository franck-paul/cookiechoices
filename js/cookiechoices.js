/*
 Copyright 2014 Google Inc. All rights reserved.

 Licensed under the Apache License, Version 2.0 (the "License");
 you may not use this file except in compliance with the License.
 You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing, software
 distributed under the License is distributed on an "AS IS" BASIS,
 WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 See the License for the specific language governing permissions and
 limitations under the License.
 */

(function () {
  if (this.cookieChoices) {
    return this.cookieChoices;
  }

  const { document } = this;
  // IE8 does not support textContent, so we should fallback to innerText.
  const supportsTextContent = 'textContent' in document.body;

  const cookieChoices = (() => {
    const cookieName = 'displayCookieConsent';
    const cookieConsentId = 'cookieChoiceInfo';
    const dismissLinkId = 'cookieChoiceDismiss';

    function _createHeaderElement(cookieText, dismissText, linkText, linkHref, bottomBar) {
      const butterBarStyles =
        'position:fixed;width:100%;background-color:#eee;' +
        'margin:0; left:0; ' +
        (bottomBar ? 'bottom' : 'top') +
        ':0;padding:4px;z-index:1000;text-align:center;';

      const cookieConsentElement = document.createElement('div');
      cookieConsentElement.id = cookieConsentId;
      cookieConsentElement.style.cssText = butterBarStyles;
      cookieConsentElement.appendChild(_createConsentText(cookieText));

      if (!!linkText && !!linkHref) {
        cookieConsentElement.appendChild(_createInformationLink(linkText, linkHref));
      }
      cookieConsentElement.appendChild(_createDismissLink(dismissText));
      return cookieConsentElement;
    }

    function _createDialogElement(cookieText, dismissText, linkText, linkHref) {
      const glassStyle =
        'position:fixed;width:100%;height:100%;z-index:999;' +
        'top:0;left:0;opacity:0.5;filter:alpha(opacity=50);' +
        'background-color:#ccc;';
      const dialogStyle = 'z-index:1000;position:fixed;left:50%;top:50%';
      const contentStyle =
        'position:relative;left:-50%;margin-top:-25%;background-color:#fff;padding:20px;box-shadow:4px 4px 25px #888;';

      const cookieConsentElement = document.createElement('div');
      cookieConsentElement.id = cookieConsentId;

      const glassPanel = document.createElement('div');
      glassPanel.style.cssText = glassStyle;

      const content = document.createElement('div');
      content.style.cssText = contentStyle;

      const dialog = document.createElement('div');
      dialog.style.cssText = dialogStyle;

      const dismissLink = _createDismissLink(dismissText);
      dismissLink.style.display = 'block';
      dismissLink.style.textAlign = 'right';
      dismissLink.style.marginTop = '8px';

      content.appendChild(_createConsentText(cookieText));
      if (!!linkText && !!linkHref) {
        content.appendChild(_createInformationLink(linkText, linkHref));
      }
      content.appendChild(dismissLink);
      dialog.appendChild(content);
      cookieConsentElement.appendChild(glassPanel);
      cookieConsentElement.appendChild(dialog);
      return cookieConsentElement;
    }

    function _setElementText(element, text) {
      if (supportsTextContent) {
        element.textContent = text;
      } else {
        element.innerText = text;
      }
    }

    function _createConsentText(cookieText) {
      const consentText = document.createElement('span');
      _setElementText(consentText, cookieText);
      return consentText;
    }

    function _createDismissLink(dismissText) {
      const dismissLink = document.createElement('a');
      _setElementText(dismissLink, dismissText);
      dismissLink.id = dismissLinkId;
      dismissLink.href = '#';
      dismissLink.style.marginLeft = '24px';
      return dismissLink;
    }

    function _createInformationLink(linkText, linkHref) {
      const infoLink = document.createElement('a');
      _setElementText(infoLink, linkText);
      infoLink.href = linkHref;
      infoLink.target = '_blank';
      infoLink.style.marginLeft = '8px';
      return infoLink;
    }

    function _dismissLinkClick() {
      _saveUserPreference();
      _removeCookieConsent();
      return false;
    }

    function _showCookieConsent(cookieText, dismissText, linkText, linkHref, isDialog, bottomBar) {
      if (_shouldDisplayConsent()) {
        _removeCookieConsent();
        const consentElement = isDialog
          ? _createDialogElement(cookieText, dismissText, linkText, linkHref)
          : _createHeaderElement(cookieText, dismissText, linkText, linkHref, bottomBar);
        const fragment = document.createDocumentFragment();
        fragment.appendChild(consentElement);
        document.body.appendChild(fragment.cloneNode(true));
        document.getElementById(dismissLinkId).onclick = _dismissLinkClick;
      }
    }

    function showCookieConsentBar(cookieText, dismissText, linkText, linkHref, bottomBar) {
      _showCookieConsent(cookieText, dismissText, linkText, linkHref, false, bottomBar);
    }

    function showCookieConsentDialog(cookieText, dismissText, linkText, linkHref, bottomBar) {
      _showCookieConsent(cookieText, dismissText, linkText, linkHref, true, false);
    }

    function _removeCookieConsent() {
      const cookieChoiceElement = document.getElementById(cookieConsentId);
      if (cookieChoiceElement !== null) {
        cookieChoiceElement.parentNode.removeChild(cookieChoiceElement);
      }
    }

    function _saveUserPreference() {
      // Set the cookie expiry to one year after today.
      const expiryDate = new Date();
      expiryDate.setFullYear(expiryDate.getFullYear() + 1);
      document.cookie = `${cookieName}=y; expires=${expiryDate.toGMTString()}`;
    }

    function _shouldDisplayConsent() {
      // Display the header only if the cookie has not been set.
      return !document.cookie.match(new RegExp(`${cookieName}=([^;]+)`));
    }

    const exports = {};
    exports.showCookieConsentBar = showCookieConsentBar;
    exports.showCookieConsentDialog = showCookieConsentDialog;
    return exports;
  })();

  this.cookieChoices = cookieChoices;
  return cookieChoices;
})();
