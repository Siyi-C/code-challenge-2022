<template>
    <div>
    
        <div class="light-box__thubList" >
            <div v-for="(item, index) in items" :key="item.id" class="light-box__thumbContainer">
                <div @click="edit != true ? lightboxEffect(index) : onClickButton(item.id, index) " :class="{ active: isActive == index }" class="light-box__thumbContainer__img" >
                    <img :id=item.id :src=" edit != true ? item.urls.thumb : item.image_path " class="light-box__thumbnail" > 
                </div>

                <p class="light-box__thumbnail__caption"  v-if="edit != true" @click="lightboxEffect(index)">{{textWrap(item.alt_description)}}</p>
               
                <div class="light-box__viewBtn" v-if="edit == true" @click="lightboxEffect(index)"><p>View large image</p></div>
            </div>
        </div>
    
        <transition name="fade" mode="out-in">
            <div @click.stop="bg = !bg" class="light-box__bg" v-if="bg"></div>
        </transition>
    
        <div v-if="bg">
            <div class="light-box__close" @click.stop="bg = !bg"></div>
            <p class="light-box__count" v-if="count">
                {{currentImage + 1 }}/
                <span>{{ thumbnails.length}}</span>
            </p>
            <div @click="prev" class="light-box__prev light-box__btn"></div>
    
            <div v-if="bg" class="light-box__container">
                <transition name="fade" mode="out-in">
                    <img :key="currentImage" :src="largeImages[currentImage]" class="light-box__container__img">
                </transition>
            </div>
    
            <div class="light-box__caption" v-if="caption && edit != true" >
                <p v-if="captions[currentImage]">{{ captions[currentImage]}}</p>
            </div>
    
            <div class="light-box__description" v-if="description && edit != true">
                <p v-if="descriptions[currentImage]">{{ descriptions[currentImage]}}</p>
            </div>
    
            <div class="light-box__addBtn" v-if="edit != true" @click="save">
                <p>Save to Library</p>
            </div>
    
            <div @click="next" class="light-box__next light-box__btn"></div>
        </div>
    </div>

   

    </template>
    
<script>
export default {
    data() {
        return {
            bg: false,
            currentImage: 0,
            count: true,
            caption: true,
            description: true,
            isActive: undefined,
        }
    },
    mounted() {
        // Close modal with 'esc' key
        document.addEventListener("keydown", (e) => {
            if (e.keyCode == 27) {
                this.bg = false;
            }
        }),

        console.log("edit" , this.edit)
    },
    props: {
        items: {
            type: Array,
            required: true
        },
        thumbnails: {
            type: Array,
            required: true
        },
        largeImages: {
            type: Array,
            required: true
        },
        captions: {
            type: Array,
            // required: true
        },
        descriptions: {
            type: Array,
            // required: true
        },
        edit:{
            type: Boolean,
            required: true
        }
    },
    methods: {
        lightboxEffect(curr) {
            this.currentImage = curr;
            this.bg = !this.bg;
           
        },
        next() {
            if (this.currentImage < this.largeImages.length - 1) {
                this.currentImage++;
            } else {
                this.currentImage = 0;
            }
        },
        prev() {
            if (this.currentImage > 0) {
                this.currentImage--;
            } else {
                this.currentImage = this.largeImages.length - 1;
            }
        },

        textWrap(text) {
            var wrappedText = text;
            if (text != null && text.length > 20) {
                wrappedText = text.slice(0, 20) + '...'
            }
            return wrappedText;
        },

        toDataURL(url, callback) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function () {
                var reader = new FileReader();
                reader.onloadend = function () {
                    callback(reader.result);
                }
                reader.readAsDataURL(xhr.response);
            };
            xhr.open('GET', url);
            xhr.responseType = 'blob';
            xhr.send();
        },

        getBase64(url) {
            return new Promise((resolve) => {
                this.toDataURL(url, (callback) => {
                    resolve(callback)
                });
            });
        },

        async save(e) {
            e.preventDefault();
            var title = this.captions[this.currentImage];
            var description = this.descriptions[this.currentImage];

            var thumbnailPath = await this.getBase64(this.thumbnails[this.currentImage]);
            var largeImagePath = await this.getBase64(this.largeImages[this.currentImage]);

                fetch('/api/add-image', {
                    method: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        title: title,
                        description: description,
                        image_path: thumbnailPath,
                        large_image_path: largeImagePath
                    })

                }).then(function (res) {
                    if (res.status === 200) {
                        alert("Added to the media library successful");
                    } else {
                        alert("Failed to add to the media library, please check your network/database connection and try again");
                    }
                })

        },

        onClickButton (id, index) {
            this.$emit('clicked', id)
            // console.log(id)
            this.isActive = (index == this.isActive ? undefined : index);
        }

    }
};
</script>
    
<style lang="scss">
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.2s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
}

.light-box {

    &__bg {
        position: fixed;
        left: 0;
        top: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(0, 0, 0, 0.89);
        z-index: 1000;
    }

    &__thumbnail {
        cursor: pointer;
        max-height: 90%;

        &__caption {
            cursor: pointer;

            &:hover {
                text-decoration: underline;
            }
        }
    }

    &__thubList {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        margin-left: 12%;
    }

    &__thumbContainer {
        margin-left: 20px;
        margin-right: 20px;
        margin-top: 20px;

        &__img {
            cursor: pointer;
            height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: center;

            &:hover {
                box-shadow: 0 0 11px rgba(33, 33, 33, .2);
            }
        }
    }

    &__close {
        padding: 10px;
        position: absolute;
        right: 20px;
        top: 20px;
        background-image: url(../../images/close.svg);
        background-size: contain;
        background-position: center;
    }

    &__container {
        position: absolute;
        z-index: 2000;
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 900px;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        min-height: 800px;

        img {
            align-self: center;
            max-height: 100vh;
        }
    }

    &__btn {
        background-size: contain;
        background-position: center;
        align-self: center;
        padding: 15px;
    }

    &__close,
    &__btn {
        cursor: pointer;
    }

    &__close,
    &__btn,
    &__caption,
    &__description,
    &__addBtn,
    &__count {
        position: absolute;
        z-index: 3000;
    }

    &__next {
        background-image: url(../../images/next.svg);
        right: 20px;
    }

    &__prev {
        background-image: url(../../images/prev.svg);
        left: 20px;
    }

    &__next,
    &__prev {
        top: 50%;
        transform: translateY(-50%);
    }

    &__caption {
        bottom: 120px;
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 20px;
        justify-content: center;
    }

    &__description {
        bottom: 70px;
        width: 100%;
        height: 50px;
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 20px;
        justify-content: center;
    }

    &__addBtn {
        bottom: 20px;
        transform: translatex(-50%);
        background-color: #8ab4f8;
        left: 50%;
        padding: 10px;
        height: 40px;
        display: flex;
        align-items: center;
        color: #fff;
        font-size: 20px;
        justify-content: center;
        border-radius: 26px;
        box-sizing: border-box;
        cursor: pointer;
    }

    &__count {
        left: 20px;
        font-size: 16px;
        color: #fff;
        top: 14px;
        padding: 0;
        margin: 0;
    }

    &__viewBtn{
        background-color: #48D1CC;
        color:#fff;
        cursor: pointer;

        &:hover {
                text-decoration: underline;
            }
    }
}
</style>
    