<template>
    <div style="padding-top: 60px;">
        <div class="music_row">
            <h4 class="row_title">Добрый вечер!</h4>
            <div class="row_cont" style="    margin-top: 15px;">
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/ab67616d0000b273b81442278960c6a7f21c800a" alt="">
                    </div>
                    <div class="hi_title">Включив, ты станешь счастливым</div>
                </div>
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/ab67706c0000da8484db0fb72ea9ca2980bb3d43" alt="">
                    </div>
                    <div class="hi_title">Плейлист</div>
                </div>
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/ab6761610000e5eb740f94ce25419fe7045236bb" alt="">
                    </div>
                    <div class="hi_title">MORGENSHTERN</div>
                </div>
            </div>
            <div class="row_cont" style="margin-top: 17px;margin-bottom: 15px">
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/3cffe518fd2708f1bd803e19e8f14c64f46cb958" alt="">
                    </div>
                    <div class="hi_title">XXXTENTACION</div>
                </div>
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/ab67616d0000b27355e74f47656c991c68045d85" alt="">
                    </div>
                    <div class="hi_title">MILLION DOLLAR: Buisness</div>
                </div>
                <div class="hi_block">
                    <div class="hi_img">
                        <img src="https://i.scdn.co/image/ab6761610000e5eb924ba0710b8c09bec669708d" alt="">
                    </div>
                    <div class="hi_title">FACE</div>
                </div>
            </div>
        </div>
        <div class="music_row">
            <h4 class="row_title">Слушаем дальше?</h4>
            <div class="row_cont">
                <div class="music_card" v-for="item in albums">
                    <router-link :to="{ name: 'album',params: { id: item.id }}">
                        <div class="card_img">
                            <img :src="item.image" alt="">
                            <button class="card_play" aria-label="Слушать"><i class="bi bi-play-fill" style=""></i></button>
                        </div>
                        <div class="card_title">
                            {{item.name}}
                        </div>
                        <div class="card_author">
                            <router-link :to="{ name: 'artist',params: { id: item.author }}">
                                {{item.author}}
                            </router-link>

                        </div>
                    </router-link>
                </div>
            </div>
        </div>
        <div class="music_row">
            <h4 class="row_title">Все альбомы</h4>
            <div class="row_cont">
                <div class="music_card" v-for="item in albumsAll">
                    <router-link :to="{ name: 'album',params: { id: item.id }}">
                        <div class="card_img">
                            <img :src="item.image" alt="">
                            <button class="card_play" aria-label="Слушать"><i class="bi bi-play-fill" style=""></i></button>
                        </div>
                        <div class="card_title">
                            {{item.name}}
                        </div>
                        <div class="card_author">
                            <router-link :to="{ name: 'artist',params: { id: item.author }}">
                                {{item.author}}
                            </router-link>
                        </div>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios';

    export default {
        name: "Album",

        data() {
            return {
                albums: [],
                albumsAll:[],

            }
        },
        methods: {
            loadPlaylist() {
                let data = {
                    'id':this.id
                };
                axios.post('/api/download',data)
                    .then(({data}) => {
                        console.log(data);
                        this.albums = data;
                    })
                axios.post('/api/allPlay',data)
                    .then(({data}) => {
                        console.log(data);
                        this.albumsAll = data;
                    })
            },
        },
        mounted() {
            this.loadPlaylist();

        }
    }
</script>
