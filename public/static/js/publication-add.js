const publicationAddForm = new Vue({
    el : "#publication-add__form",
    data : {
        categoryList : {},
        categoryValue : "",
        description : "",
        file: "",
        fileData : {
            errors : [],
            valid : false,
        },
        previewImage : null
    },
    mounted : function () {
        axios.get("/get-category-list").then(response => {
            console.log(response.data);
            this.categoryList = response.data;
        });
    },
    methods : {
        uploadImage : function (e){

            this.previewImage = '';
            this.file = e.target.files[0];
            console.log(this.file);
            if (!['image/jpeg','image/jpg','image/png','image/gif'].includes(this.file.type)){
                this.addImageError(
                    `Расширение загруженного файла - ${this.file.type}. Разрешены только jpeg, jpg, gif или png`
                );
                return;
            }
            const reader = new FileReader();
            reader.readAsDataURL(this.file);
            reader.onload = e => {
                this.previewImage = e.target.result;
                console.log(this.previewImage);
            }
        },
        removeImage : function (){
            document.getElementById("file__input").value = '';
        },
        addImageError : function (message){
            this.fileData.errors.push(message);
            this.removeImage();
        }


    },
    computed : {
        imageData : function (){
            let data = {
                name : this.file.name,
                size : (this.file.size / 1024 / 1024).toFixed(2) + "МБ",
                type : this.file.type
            };
            return data;
        }
    }
});