export function AskForNotificationPermission(next){
    if('Notification' in window && Notification.permission !== 'denied'){
        Notification.requestPermission().then(next);
    } else {
        next();
    }
}
export default function(){
    window.AskForNotificationPermission = AskForNotificationPermission;
}
