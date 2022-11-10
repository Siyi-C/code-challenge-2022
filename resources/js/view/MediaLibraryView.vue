<template> 
    <div class="container media">
        <div class="media__library">
            <!-- <div v-for="(item, index) in list" :key="item.id">
            <img :src="item.image_path" style="margin-top: 10px;" @click="singleImage(item.id)"/>
            </div> -->

            <LightBox @clicked="onClickChild"
            :items="lightbox.items"
            :thumbnails="lightbox.images.thumbnails"
            :largeImages="lightbox.images.largeImages"
            :edit="lightbox.edit"
            />
           
        </div> 

        <div class="media__edit">
            <Edit
            :title="title"
            :description="description"
            :id="id"
            />  
        </div>

    </div>
   
    <!-- <div class="edit-btn" @click="edit(this.id)"><p>Edit</p></div> -->
   
</template>

<script>
import axios from 'axios'
import Edit from '../components/Edit.vue'
import LightBox from '../components/LightBox.vue'
export default {
    components: {
        Edit,
        LightBox
    },

    data(){
        return {
        //    list:[],
           title:"",
           description: "",
           id:"",
           lightbox: {
                items:[],
                images: {
                    thumbnails: [],
                    largeImages: [],
                }, 
                edit: true
           }
        }
    },
    methods: {
        allImageDetails(){
            axios.get('/api/all')
            .then((res) => {
                //console.log(res)
                // this.list = res.data
                this.lightbox.items = res.data
                this.lightbox.images.thumbnails=[]
                res.data.forEach(e => {
                    console.log("e", e)
                        this.lightbox.images.thumbnails.push(e.image_path)
                        this.lightbox.images.largeImages.push(e.large_image_path)
                        // console.log(this.lightbox.descriptions)
                });
            })
        },

        singleImage(id){
            axios.get('/api/all/' + id)
            .then((res) => {
                //console.log(res)
                this.title = res.data.title
                this.description = res.data.description
                //console.log(this.title)
                // this.list = res.data
                this.id = id
            })
        },

        onClickChild (id) {
            this.singleImage(id)
            console.log(id)
        },

        // updateparent(variable) {
        //     this.parentvariable = variable
        // }

    },
    mounted(){
        this.allImageDetails()
    }
}

</script>

<style lang="scss">
.media {
   display: flex;
   justify-content: space-around;

   &__library {
    width: 60%;
    text-align: center;
   }

   &__edit {
    width: 40%;
    margin-right: 5%;
    margin-top: 20px
   }
}
</style>