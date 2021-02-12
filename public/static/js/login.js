const loginForm = new Vue({
    el: "#login__form",
    data: {
        nickname: "",
        password: "",
        curtain: false,
        errors: []
    },
    methods: {
        checkLogin: async function (e) {
            this.errors = [];
            if (this.nickname.length < 5)
            {
                this.errors = ["Ник должен содержать не менее 5-ти символов "];
                return;
            }
            if (this.password.length < 5)
            {
                this.errors = ["Пароль должен содержать не менее 5-ти символов "];
                return;
            }

            await this.checkDB();
            if (this.errors.length === 0) {
                this.resetForm();
                this.submitForm();
            }

        },
        checkDB: async function () {
            this.curtain = true;
            let url = "/check-login?nickname=" + this.nickname + "&password=" + this.password;
            let response = await axios.get(url);
            console.log(response.data);
            this.curtain = false;
            if (!(response.data === "valid")) {
                this.errors = response.data;
            }
        },
        submitForm: function () {
            document.getElementById("login__form").submit();
        },
        resetForm :function (){
            this.nickname = "";
            this.password = ""
        }
    }
});