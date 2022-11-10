import { ref } from 'vue';
import axios from 'axios';

export default function useImage(){

    const imageGallery = ref([])
    const imageDetail = ref([])
    const errors = ref([])
    const imageId = ref([])

    const getImages = async() => {
        let response = await axios.get('/api/all')
        imageGallery.value = response.data
        //console.log(imageGallery.value)
    } 

    //single image details
    const getDetails = async(id) => {
        let response = await axios.get('/api/all/' + id)
        console.log("single img response: ")
        console.log(response)
        imageDetail.value = response.data
        imageId.value = response.data.id
        console.log(response.data.id)
        //console.log("image "  + imageDetail.value)
    } 
   
    // const storeImages = async(data) => {
    //     await axios.post('/api/add-image', data);
    //     await router.push({name: "home"});

    // }

    const editImage = async(id) => {
        try {
            await axios.put('/api/update/' + id, imageDetail.value);
            alert("Updated Successfully")
        } catch (error) {
           console.log(error)
        }
        
    }

     // object
     return {
        imageGallery,
        getImages,
        imageDetail,
        getDetails,
        // storeImages,
        editImage,
        errors,
        imageId
    }
}