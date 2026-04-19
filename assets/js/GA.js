// Google Analytics 4
// Replace G-XXXXXXXXXX with your GA4 Measurement ID (https://analytics.google.com)
const GA_MEASUREMENT_ID = 'G-XXXXXXXXXX';

const script = document.createElement('script');
script.async = true;
script.src = `https://www.googletagmanager.com/gtag/js?id=${GA_MEASUREMENT_ID}`;
document.head.appendChild(script);

window.dataLayer = window.dataLayer || [];
function gtag(...args) {
    window.dataLayer.push(args);
}
window.gtag = gtag;

gtag('js', new Date());
gtag('config', GA_MEASUREMENT_ID);
