function changerBg(param) {
    if(param === 1) {
        document.getElementsByTagName("body")[0].style.background = 'linear-gradient(270deg, rgba(254, 225, 64, 0.76) 0%, rgba(250, 112, 154, 0.84) 100%)';
    }
    if(param === 2) {
        document.body.style.background = 'linear-gradient(90deg, #FC466B 0%, #3F5EFB 100%)';
    }
    if(param === 3) {
        document.body.style.background = 'linear-gradient(19deg, #21D4FD 0%, #B721FF 100%)';
    }
    if(param === 4) {
        document.getElementsByTagName('body')[0].style = 'background: linear-gradient(90deg, #4b6cb7 0%, #182848 100%)';
    }
}