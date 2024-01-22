/*global dotclear */
'use strict';

document.addEventListener('DOMContentLoaded', () => {
  const settings = dotclear.getData('cookiechoices_settings');
  if (settings.dialog) {
    cookieChoices.showCookieConsentDialog(settings.message, settings.close, settings.learnmore, settings.url, settings.bottom);
  } else {
    cookieChoices.showCookieConsentBar(settings.message, settings.close, settings.learnmore, settings.url, settings.bottom);
  }
});
