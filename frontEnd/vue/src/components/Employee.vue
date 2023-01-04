<template>
    <!-- <h2>This is Employee page</h2> -->

    <!-- <div class="empList">
        <form @submit.prevent="saveData">
            <input v-model="state.employee.name" type="text" placeholder="Enter Your Name"><br>
            <input v-model="state.employee.address" type="text" placeholder="Enter your address"><br>
            <input v-model="state.employee.number" type="text" placeholder="Enter your number">
            <button type="submit">Submit</button>
        </form>
        <ul v-for="employe in state.result" :key="employe.id">
            <li>{{ employe.name }}</li>
            <li>{{ employe.address }}</li>
            <li>{{ employe.number }}</li>
            <button type="button" @click="deleteDAta(employe.id)">Delete</button>
            <button type="button" @click="state.employee = employe; updateData(employe.id)">Update</button>
        </ul>
    </div> -->
    <div class="container">
        <h2>Employee Information</h2>

        <!-- <form @submit.prevent="save">
            <input v-model="state.employee.name" type="text" placeholder="Enter Your Name"><br>
            <input v-model="state.employee.address" type="text" placeholder="Enter your address"><br>
            <input v-model="state.employee.number" type="text" placeholder="Enter your number"><br>
            <button type="submit">Submit</button>
        </form> -->
        <form @submit.prevent="save" class="table">

            <div class="form-group">
                <label>Employee Name</label>
                <input v-model="state.employee.name" type="text" class="form-control" placeholder="Enter Employee Name"
                    required>
            </div>
            <div class="form-group">
                <label>Employee Address</label>
                <input v-model="state.employee.address" type="text" class="form-control"
                    placeholder="Enter Employee Address" required>
            </div>
            <div class="form-group">
                <label>Employee Mobile</label>
                <input v-model="state.employee.number" type="text" class="form-control"
                    placeholder="Enter Employee Mobile" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <!-- 
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Number</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="employe in state.result" :key="employe.id">
                    <td>{{ employe.name }}</td>
                    <td>{{ employe.address }}</td>
                    <td>{{ employe.number }}</td>
                   
                    <button type="button" class="btn btn-danger" @click="deleteDAta(employe.id)">Delete</button>
                    <button type="button" class="btn btn-primary"
                        @click="state.employee = employe; updateData(employe.id)">Update</button>
                </tr>

            </tbody>
        </table> -->
        <h2>Employee View</h2>
        <table v-if="!loading" class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Employee Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Mobile</th>
                    <th scope="col">Option</th>
                </tr>
            </thead>

            <tbody>
                <tr v-for="(employe, index) in state.result.data" v-bind:key="employe.id">

                    <td>{{  (index + 1) }}</td>
                    <!-- <td>{{ index + 1 }}</td> -->
                    <td>{{ employe.name }}</td>
                    <td>{{ employe.address }}</td>
                    <td>{{ employe.number }}</td>
                    <td>
                        <button type="button" class="btn btn-warning" @click="state.employee = employe; updateData(employe.id)">Edit</button>
                        <button type="button" class="btn btn-danger" @click="deleteDAta(employe.id)">Delete</button>
                    </td>

                </tr>

            </tbody>
            <Bootstrap5Pagination align="center" :data="state.result" @pagination-change-page="employeeLoad"></Bootstrap5Pagination>
        </table>
    </div>

</template>

<script setup>
import {Bootstrap5Pagination} from 'laravel-vue-pagination';

import {
    reactive
} from 'vue';
import axios from 'axios';

const state = reactive({

    employee: {
        id: '',
        name: '',
        address: '',
        number: '',
    },
    result: {},

});

function employeeLoad(page = 1) {

    axios.get("http://127.0.0.1/api/index?page=${page}")
        .then(
            ({
                data

            }) => {
                console.log(data);
                state.result = data;
            }
        );
}

function save() {
    //console.log(state.employee.id);
    if (state.employee.id) {
        updateData(state.employee.id);
    }
    else {
        saveData();
    }
}


function saveData() {
    var del = "http://127.0.0.1/api/save";
    axios.post(del, state.employee)
        .then(
            ({
                data
            }) => {
                console.log(data);
                employeeLoad();
            }
        );
}

function deleteDAta(id) {
    var del = "http://127.0.0.1/api/delete/" + id
    axios.delete(del).then(() => {
        //console.log("success");
        employeeLoad();
    });


}

function updateData(id) {
    var del = "http://127.0.0.1/api/update/" + id;
    axios.put(del, state.employee).then(() => {
        employeeLoad();
    });

}

employeeLoad();


</script>

<style scoped>
li {
    list-style-type: none;
}

.empList {}
</style>
