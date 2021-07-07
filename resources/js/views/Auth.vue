<template>
    <div style="padding-top: 44px;display: flex;">
        <div class="register_form">
                <h4 style="font-weight: bold">Регистрация</h4>
                <br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Введите адрес электронной почты</label>
                    <input type="email" class="form-control" v-model="regEmail" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Подтвердите адрес электронной почты
                    </label>
                    <input type="text" class="form-control" v-model="regEmail2" placeholder="Введите адрес электронной почты еще раз">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1"  class="form-label">Придумайте пароль
                    </label>
                    <input type="password" class="form-control" v-model="regPass" placeholder="Придумайте пароль">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1"  class="form-label">Ваше имя
                    </label>
                    <input type="text" class="form-control" v-model="regName" placeholder="Укажите свое имя">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Дата рождения
                    </label>
                    <input type="date" class="form-control" v-model="regDate" placeholder="Укажите свое имя">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="exampleCheck1">Согласен с условиями использования Spotify</label>
                </div>
                <button type="submit" class="btn btn-success" style="background-color: #1db954;" @click="register">Регистрация</button>
        </div>
        <div class="register_form">
                <h4 style="font-weight: bold">Авторизация</h4>
                <br>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Введите адрес электронной почты</label>
                    <input type="email" class="form-control" v-model="authEmail" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Придумайте пароль
                    </label>
                    <input type="password" class="form-control" v-model="authPass" id="exampleInputPassword1" placeholder="Введите пароль">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Запомнить меня</label>
                </div>
                <button type="submit" class="btn btn-success" style="background-color: #1db954;" @click="login">Войти</button>
        </div>
    </div>
</template>

<script>
    import axios from "axios";

    export default {
        data() {
            return {
                regEmail:'',
                regEmail2:'',
                regPass:'',
                regName:'',
                regDate:'',
                authEmail:'',
                authPass:''
            }
        },
        methods: {
            register() {
                if(this.regEmail != this.regEmail2) {
                    alert('Адресы электронной почты должны совпадать!');
                }
                let data = {
                    'email': this.regEmail,
                    'name': this.regName,
                    'password': this.regPass,
                    'birthday': this.regDate,
                };
                axios.post('/api/register', data)
                    .then(({data}) => {
                        if(data['status'] == 'success') {
                            alert('Вы успешно зарегистрировались!');
                        }
                    })
            },
            login() {
                let data = {
                    'email': this.authEmail,
                    'password': this.authPass,
                };
                axios.post('/api/login', data)
                    .then(({data}) => {
                        if(data['token']) {
                            setCookie('token',data['token']);
                            window.location.href = '/';
                            alert('Успешная авторизация!')
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
