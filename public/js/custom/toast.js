
function successToast(message){
    new Notify ({
        status: 'success',
        title: 'SUCCESS',
        text: message,
        effect: 'fade',
        speed: 300,
        customClass: '',
        customIcon: '',
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: 5000,
        gap: 60,
        distance: 20,
        type: 1,
        position: 'right top',
        customWrapper: '',
    })
}

function errorToast(message){
    new Notify ({
        status: 'error',
        title: 'ERROR',
        text: message,
        effect: 'fade',
        speed: 300,
        customClass: '',
        customIcon: '',
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: 5000,
        gap: 60,
        distance: 20,
        type: 1,
        position: 'right top',
        customWrapper: '',
    })
}

function InfoToast(message){
    new Notify ({
        status: 'info',
        title: 'INFO',
        text: message,
        effect: 'fade',
        speed: 300,
        customClass: '',
        customIcon: '',
        showIcon: true,
        showCloseButton: true,
        autoclose: true,
        autotimeout: 5000,
        gap: 60,
        distance: 20,
        type: 1,
        position: 'right top',
        customWrapper: '',
    })
}