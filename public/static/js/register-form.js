const form = new Vue({
    el: "#register__form",
    data: {
        nickname: "",
        nicknameData: {
            errors: [],
            valid: null
        },
        email: "",
        emailData: {
            errors: [],
            valid: null
        },

        password: "",
        passwordData: {
            errors: [],
            valid: null,
            showPassword : false,
        },
        description : ""
    },
    methods: {
        checkForm: function (e) {
            if (this.validForm()){
                e.reset();
                return true;
            }
            e.preventDefault();
        },
        addError: function (field, message) {
            // field - номер поля ( nickname - 1,
            // email - 2 , password - 3 , age -4 )
            let errorList;
            let validValue;
            switch (field) {
                case 1:
                    errorList = this.nicknameData.errors;
                    this.nicknameData.valid = false;
                    break;
                case 2:
                    errorList = this.emailData.errors;
                    this.emailData.valid = false;
                    break;
                case 3:
                    errorList = this.passwordData.errors;
                    this.passwordData.valid = false;
                    break;
                case 4:
                    errorList = this.passwordData.errors;
                    this.passwordData.valid = false;
                    break;
            }
            errorList.push(message);
        },
        checkDB: async function (field, value) {
            return await axios.get(`/check-user-register?${field}=${value}`);
        }

    },
    watch: {
        nickname: function () {
            this.nickname = this.nickname.trim();
            this.nicknameData.errors = [];
            if (this.nickname.length === 0) {
                this.addError(1, "Введите ваш ник");
                return;
            }
            if (this.nickname.length < 5) {
                this.addError(1,
                    "Ник должен быть не меньше 5-ти символов(у Вас "
                    + this.nickname.length + ")");
                return;
            }

            if (!(/^[A-Za-z_0-9]+$/).test(this.nickname)) {
                this.addError
                (1,
                    "Ваш ник должен содержать только буквы латинского алфавита" +
                    ",цифры или знак нижнего подчеркивания"
                )
                return;
            }


            this.checkDB("nickname", this.nickname).then(response => {
                if (response.data === "+") {
                    this.addError(1, `Ник ${this.nickname} уже занят!`)
                    return;
                }
            });
            this.nicknameData.valid = true;
        },
        email: function () {
            this.email = this.email.trim();
            this.emailData.errors = [];
            if (this.email.length === 0) {
                this.addError(2, "Введите ваш адрес электронной почты");
                return;
            }
            let regEmail = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/
            if (!regEmail.test(this.email)){
                this.addError(
                    2,
                    "Введен некорректный адрес электронной почты." +
                    "Email должен быть по типу 'login.3@i.ru' или '123456@ru.name.ru' "
                );
                return;
            }
            this.checkDB("email",this.email).then(response=>{
                if (response.data === "+") {
                    this.addError(2, `Email ${this.email} уже используется другим пользователем!`)
                    return;
                }
            });

            this.emailData.valid = true;
        },
        password : function () {
            this.password = this.password.trim();
            this.passwordData.errors = [];

            if (this.password.length === 0){
                this.addError(3,"Введите пароль");
                return;
            }
            if (this.password.length<5){
                this.addError(
                    3,
                    "Пароль должен состоять не менее чем " +
                    "из пяти символов"
                )
                return;
            }
            if (!(/^[A-Za-z0-9]+$/).test(this.password)){
                this.addError(
                    3,
                    "Пароль должен содержать только буквы латинского алфавита и цифры"
                )
                return;
            }
            if (!(/[A-Z]/).test(this.password)){
                this.addError(
                    3,
                    "Пароль должен иметь минимум один заглавный символ"
                )
                return;
            }
            if (!(/[0-9]/).test(this.password)){
                this.addError(
                    3,
                    "Пароль должен иметь минимум одну цифру"
                )
                return;
            }



            this.passwordData.valid = true;
        }
    },
    computed: {
        validForm: function () {
            if (
                this.nicknameData.valid &&
                this.emailData.valid &&
                this.passwordData.valid
            ) {
                return true;
            } else {
                return false;
            }
        },
        passwordType : function (){
            return !this.passwordData.showPassword ? 'password' : "text";
        },
        passwordReliability : function (){
            let reliability = false;
            let relClass = null;
            let passwordLen = this.password.length;
            if (passwordLen >= 5 && passwordLen <= 8){
                reliability = "Слабая";
                relClass = "low";
            } else if(passwordLen > 8 && passwordLen <13){
                reliability = "Средняя";
                relClass = "medium"
            } else if (passwordLen >=13){
                reliability = "Высокая";
                relClass = "high";
            }
            return {
                reliability : reliability,
                relClass : relClass
            }
        }
    },
});