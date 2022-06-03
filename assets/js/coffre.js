(() => {
    var timerElement = document.getElementById("count-down-timer");
    if (null === timerElement) {
    return;
    }
    
    // Construit le timer
    setInterval(() => {
    let values = timerElement.innerHTML.split(':');
    let sec = parseInt(values[1]);
    let min = parseInt(values[0]);
    
    if (sec > 0) {
    values[1] = sec - 1;
    // Traitement des 0
    if (10 > values[1]) {
    values[1] = '0' + values[1];
    }
    } else if (sec === 0 && min > 0) {
    values[0] = min - 1;
    values[1] = 59;
    } else {
    return timerElement.innerHTML = 'Ready !';
    } timerElement.innerHTML = values[0] + ':' + values[1];
    }, 1000);
    })();