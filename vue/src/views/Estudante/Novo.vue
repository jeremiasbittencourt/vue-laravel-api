<template>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h4>Novo Estudante</h4>
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
                    <button type="button" @click="salvarEstudante" class="btn btn-primary">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';


export default {
    name: 'estudanteNovo',
    data(){
        return{
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
    methods: {
        salvarEstudante()
        {
            var mythis = this;
            axios.post('http://localhost:8000/api/estudantes', this.model.estudante)
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