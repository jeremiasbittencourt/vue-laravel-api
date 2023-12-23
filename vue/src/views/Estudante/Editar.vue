<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Editar Estudante</h4>
            </div>
            <div class="card-body">

                <ul class="alert alert warning" v-if="Object.keys(this.errorList).length > 0">
                    <li class="mb-0 ms-3" v-for="(error, index) in this.errorList" :key="index">
                        {{ error[0] }}                        
                    </li>
                </ul>

                <div class="mb-3">
                    <label for="">Nome</label>
                    <input type="text" v-model="model.estudante.nome" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Curso</label>
                    <input type="text" v-model="model.estudante.curso" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">E-mail</label>
                    <input type="text" v-model="model.estudante.email" class="form-control" />
                </div>
                <div class="mb-3">
                    <label for="">Celular</label>
                    <input type="text" v-model="model.estudante.celular" class="form-control" />
                </div>
                <div class="mb-3">
                    <button type="button" @click="editarEstudante" class="btn btn-primary">Editar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';


export default {
    name: 'estudanteEditar',
    data(){
        return{
            idEstudante: '',
            errorList: '',
            model: {
                estudante: {
                    nome: '',
                    curso: '',
                    email: '',
                    celular: ''
                }
            }
        }
    },
    mounted(){
        // console.log(this.$route.params.id);
        this.idEstudante = this.$route.params.id;
        this.getDadosEstudante(this.$route.params.id);
    },
    methods: {

        getDadosEstudante(idEstudante){

            axios.get(`http://localhost:8000/api/estudantes/${idEstudante}/edit`)
                .then(res => {

                    this.model.estudante = res.data.estudante

                })

                 .catch(function (error) {

                    if(error.response){

                        if(error.response.status == 404)
                        {
                            alert(error.response.data.message);
                        }

                    }

                });
        },

        editarEstudante()
        {
            var mythis = this;
            axios.put(`http://localhost:8000/api/estudantes/${this.idEstudante}/edit`, this.model.estudante)
                .then(res => {
                    
                    console.log(res.data)
                    alert(res.data.message);

                    this.model.estudante = {
                                nome: '',
                                curso: '',
                                email: '',
                                celular: ''
                    }
                    this.errorList = '';
                })
                .catch(function (error) {

                    if(error.response){

                        if(error.response.status == 422)
                        {
                            mythis.errorList = error.response.data.errors;
                        }
                        if(error.response.status == 404)
                        {
                            alert(error.response.data.message);
                        }

                        // console.log(error.response.data);
                        // console.log(error.response.status);
                        // console.log(error.response.headers);
                    } else if(error.request) {
                        console.log(error.request);
                    } else {
                        console.log('Error', error.message);
                    }

                });
        }
    },
}

</script>