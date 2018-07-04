/**
 * Created by HI on 11/3/2016.
 */

    $(document).ready(function (){
        var url      = window.location.href;     // Returns full URL
        var path = url.substring(0, url.lastIndexOf("/"));
        $(document).idleTimeout({
            redirectUrl: path+'/logout.php',      // redirect to this url on logout. Set to "redirectUrl: false" to disable redirect

            // idle settings
            idleTimeLimit: 1800,           // 'No activity' time limit in seconds. 1800 = 30 Minutes
            idleCheckHeartbeat: 2,       // Frequency to check for idle timeouts in seconds

            // optional custom callback to perform before logout
            customCallback: false,       // set to false for no customCallback
            // customCallback:    function () {    // define optional custom js function
            // perform custom action before logout
            // },

            // configure which activity events to detect
            // http://www.quirksmode.org/dom/events/
            // https://developer.mozilla.org/en-US/docs/Web/Reference/Events
            activityEvents: 'click keypress scroll wheel mousewheel mousemove', // separate each event with a space mousemove

            // warning dialog box configuration
            enableDialog: true,           // set to false for logout without warning dialog
            dialogDisplayLimit: 300,       // 300 seconds (5 min) for testing. Time to display the warning dialog before logout (and optional callback) in seconds. 180 = 3 Minutes
            dialogTitle: 'Session Expiration Warning', // also displays on browser title bar
            dialogText: 'Because you have been inactive, your session is about to expire.',
            dialogTimeRemaining: 'Time remaining',
            dialogStayLoggedInButton: 'Stay Logged In',
            dialogLogOutNowButton: 'Log Out Now',

            // error message if https://github.com/marcuswestin/store.js not enabled
            errorAlertMessage: 'Please disable "Private Mode", or upgrade to a modern browser. Or perhaps a dependent file missing. Please see: https://github.com/marcuswestin/store.js',

            // server-side session keep-alive timer
            sessionKeepAliveTimer: 600,   // ping the server at this interval in seconds. 600 = 10 Minutes. Set to false to disable pings
            sessionKeepAliveUrl: window.location.href // set URL to ping - does not apply if sessionKeepAliveTimer: false
        });
    });