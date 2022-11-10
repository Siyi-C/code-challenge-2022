<template>
    <div class="container">
       
        <div class="search-area">
            <h3>Search:</h3>
            <input type="text" placeholder="Search image" v-model="search" />
            <input type="submit"  @click="getImg"/> 
       
<!-- 
        <div>

         
            <form class="form" v-if="show" @submit="addToDb">

                <p v-if="errors.length" style="color: red">
                    <b>Please fill these fields below: </b>
                    <ul>
                    <li v-for="error in errors">{{ error }}</li>
                    </ul>
                </p>

                <label for="title">Title</label>
                <input type="text" v-model="title" >

                <label for="desc">Description</label>
                <input type="text" v-model="description" />

                <input type="submit" value="add" name="add"/> 

            </form>
        </div>        -->
    </div>
    <LightBox
      :items="lightbox.items"
      :thumbnails="lightbox.images.thumbnails"
      :largeImages="lightbox.images.largeImages"
      :captions="lightbox.captions"
      :descriptions="lightbox.descriptions"
      class="lightBox"
    />

        <!-- <ul class="image-gallery">
            <div v-for="(item, index) in list" :key="item.id" @click="generateImageToBase64($event)">
                <li>
                    <img :src="item.urls.small" id="my-image" @click="changeSelected(index)" v-bind:class="{ active: isActive == index }" crossorigin/> 
                </li>
            </div>
        </ul> -->



    </div>
 
</template>

<script>
import axios from 'axios'
import LightBox from './LightBox.vue'


    export default{
        components: {
            LightBox
        } ,
        data(){
            return {
                list:[],
                search: "",
                title:"",
                description:"",
                image_path: "",
                // show: false,
                errors:[], 
                isActive: undefined,
                lightbox: {
                    items:[],
                    images: {
                        thumbnails: [],
                        largeImages: [],
                        },  
                    captions: [],
                    descriptions: [],
                },              
                index: null
            }
        },

        methods: {

            changeSelected(index) {
                this.isActive = (index == this.isActive ? undefined : index);
            },

            getImg() {
                // this.show = true
                axios.get(`https://api.unsplash.com/search/photos?page=1&query=${this.search}&client_id=v2CLzDkWNRJl7uVQkN-LlzXuEpiQwHxK6b7OudCoDpE`)
                .then((res) => {
                    this.list = res.data['results']
                    this.lightbox.items = res.data['results']
                    this.lightbox.images.thumbnails=[]
                    this.lightbox.images.largeImages=[]
                    this.lightbox.captions=[]
                    this.lightbox.descriptions=[]
                    this.list.forEach(e => {
                        this.lightbox.images.thumbnails.push(e.urls.thumb)
                        this.lightbox.images.largeImages.push(e.urls.regular)
                        this.lightbox.captions.push(e.alt_description)
                        this.lightbox.descriptions.push(e.description)
                        // console.log(this.lightbox.descriptions)
                    });
                    // console.log(this.list)
                }).catch(err => console.log(err))
            },
  
            // generateImageToBase64(event){
            //     console.log(event.target)
                
            //     const getBase64StringFromDataURL = (dataURL) =>
            //     dataURL.replace('data:', '').replace(/^.+,/, '');

            //     const image = event.target;
            //     //console.log(image)

            //     const toDataURL = () => {
            //     const canvas = document.createElement('canvas');
               
            //     // get the real image size 
            //     canvas.width = image.naturalWidth;
            //     canvas.height = image.naturalHeight;

            //     // rawing context and draw the image in the top left
            //     canvas.getContext('2d').drawImage(image, 0, 0);

            //     // Convert canvas to DataURL and log to console
            //     this.image_path = canvas.toDataURL();
            //     //console.log(this.image_path);

            //     // Convert to Base64 string
            //     // const base64 = getBase64StringFromDataURL(dataURL);
            //     //this.image_path = getBase64StringFromDataURL(dataURL);
            //     //console.log(this.image_path);
            //     };

            //     // If the image has already loaded
            //     if (image.complete) toDataURL(image);
            //     // Wait for the image to load before converting
            //     else image.onload = toDataURL;
            // },

            // addToDb(e){
            //     e.preventDefault();

            //     this.errors = [];
            //     this.errMessage = [];

            //     if (this.title === '' ) {
            //         this.errors.push(' Title fields are missing ');
            //     }else if (this.description === '' ){
            //         this.errors.push(' Description fields are missing');
            //     }else if (this.image_path === '' ){
            //         this.errors.push(' Please select image');
            //     }else
            //         fetch('/api/add-image',{
            //             method: 'POST',
            //             headers: {
            //             'Accept': 'application/json',
            //             'Content-Type': 'application/json',
            //             },
            //             body: JSON.stringify({title: this.title, description: this.description, image_path: this.image_path})
                    
            //     }).then(function(res){
            //         if(res.status === 200){
            //             alert("Added to the media library successful");
            //         }else{
            //             alert("Failed to add to the media library, please check your network/database connection and try again");
            //         }
            //     })
            //         // .then()
            // },

        }        
    }

</script>

