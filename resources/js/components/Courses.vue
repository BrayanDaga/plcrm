<template>
<div>
    <h4>Último Agregado</h4>
    <div class="card" style="width: 22rem;">
        <img class="card-img-top" :src="latest.urlImage" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{latest.title}}</h5>
            <p class="card-text text-justify h-50">{{latest.description}}.</p>
        </div>
        <div class="container">
            <p class="text-right"><a :href="linkEdit(latest.id)" class="btn btn-primary">Editar curso</a></p>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-6 text-left">{{latest.name}}</div>
                <div class="col-6 text-right">S/ {{latest.price}}</div>
            </div>
        </div>
    </div>
    <h4>Demás cursos</h4>
    <div class="row">
        <div class="col-sm-6 col-lg-4 col-xl-4 mb-3" v-for="(show,index) in courses" :key="index">
            <div class="card h-100 mb-0">
                <img class="card-img-top" :src="show.urlImage" alt="Card image cap">
                <div class="card-body mb-0">
                    <h5 class="card-title">{{show.title}}</h5>
                    <p class="card-text text-justify h-50">{{show.description}}</p>
                </div>
                <div class="container">
                    <p class="text-right"><a :href="linkEdit(show.id)" class="btn btn-primary">Editar curso</a></p>
                </div>
                <div class="card-footer">
                    <div class="row">
                        <div class="col-6">{{show.name}}</div>
                        <div class="col-6 text-right">S/ {{show.price}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data(){
        return {
            courses:[],
            latest:[]
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
                this.courses = response.data;
                this.latest = response.data[0];
            })
            .catch((error) => {
            console.log(error);
            });
        },
        linkEdit(id){
            return `/creator/courses/${id}/edit`;
        }
    }
}

</script>

<style>

</style>