
<!-- import { RouterLink } from 'vue-router'; -->
<template>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Estudantes
                <RouterLink to="/estudante/novo" class="btn btn-primary float-end">
                    Novo Estudante
                </RouterLink>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Curso</th>
                            <th>E-mail</th>
                            <th>Celular</th>
                            <th>Data de criação</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody v-if="this.estudantes.length > 0">
                        <tr v-for="(estudante, index) in this.estudantes" :key="index">
                            <td>{{ estudante.id }}</td>
                            <td>{{ estudante.nome }}</td>
                            <td>{{ estudante.curso }}</td>
                            <td>{{ estudante.email }}</td>
                            <td>{{ estudante.celular }}</td>
                            <td>{{ estudante.created_at }}</td>
                            <td>
                                <RouterLink :to="{ path: '/estudantes/'+estudante.id+'/editar' }" class="btn btn-success">
                                    Editar
                                </RouterLink>
                                <button type="button" @click="deletarEstudante(estudante.id)" class="btn btn-danger mx-2">
                                    Deletar
                                </button>
                            </td>

                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr>
                            <td colspan="7">
                                Carregando...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>

import axios from 'axios'

export default {
    nome: 'estudantes',
    data(){
        return {
            estudantes: []
        }
    },
    mounted(){

        this.getStudents();

    },
    methods: {
        getStudents(){
            axios.get('http://localhost:8000/api/estudantes').then(res => {

                this.estudantes = res.data.estudantes
                console.log(this.estudantes)
            });
        },

        deletarEstudante(idEstudante){

            if(confirm('Tem certeza que deseja deletar esse estudante?')){
                
                axios.delete(`http://localhost:8000/api/estudantes/${idEstudante}/delete`)
                .then(res => {

                    alert(res.data.message);

                    this.getStudents();

                })
                .catch(function (error) {
                  if(error.response){
                    if(error.response.status == 404)
                    {
                        alert(error.response.data.message)
                    }
                  }
                });
            }
        }
    },
}
</script>
  