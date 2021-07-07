<template>
    <div style="padding-top: 44px;">
        <div class="addAlbum">
            <div class="register_form">
                    <h4 style="font-weight: bold">Создание альбома</h4>
                    <br>
                    <div class="mb-3">
                        <label class="form-label">Название релиза</label>
                        <input type="email" v-model="name" class="form-control" placeholder="Введите название релиза">
                    </div>
                    <div class="mb-3">
                        <label  class="form-label">Автор
                        </label>
                        <input type="text" v-model="author" class="form-control" placeholder="Введите автора">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Год выхода
                        </label>
                        <input type="text" v-model="year" class="form-control" id="exampleInputPassword1" placeholder="Год выхода">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Изображение
                        </label>
                        <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Согласен с условиями использования Spotify</label>
                    </div>
                    <button type="submit" @click="create" class="btn btn-success" style="background-color: #1db954;">Регистрация</button>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        data() {
            return {
                file: '',
                name:'',
                author:'',
                year:''
            }
        },
        methods: {
            handleFileUpload() {
                this.file = this.$refs.file.files[0];
            },
            create() {
                let data = new FormData;
                data.append('image',this.$refs.file.files[0]);
                data.append('name',this.name);
                data.append('author',this.author);
                data.append('year',this.year);

                axios.post('/api/addNew',data)
                    .then(({data}) => {
                        console.log(data);
                    })
            }
        }
    }
</script>

<style scoped>

</style>
