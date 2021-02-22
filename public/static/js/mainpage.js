new Vue({
    el : "#mainpage",
    data : {
        popularPublic : DATA.popularPublications,
        currentSlide : 1
    },
    methods : {
        changeSlide(num){
            let waitingSlide = this.currentSlide + num;
            if (waitingSlide > this.popularPublic.length){
                this.currentSlide = 1;
            }else if(waitingSlide < 1) {
                this.currentSlide = this.popularPublic.length;
            } else{
                this.currentSlide = waitingSlide;
            }
        },
        getSlide(index){
            this.currentSlide = index;
        }
    },
});