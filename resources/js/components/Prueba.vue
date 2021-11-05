<template>
    
  <div>{{name}}</div>

</template>

<script>
export default {
    data(){
        return {
            name:"jhonatan",
            user: {},
            courses:[]
        }
    },
    mounted(){//llamar 
        this.listUser();
    },
    methods:{
        listUser() {
        axios
            .get(`/courses/list/producer`)
            .then((response) => {
            // console.log(response);
            this.courses = response.data;
            })
            .catch((error) => {
            console.log(error);
            });
        }
    }
}

</script>

<style>

</style>