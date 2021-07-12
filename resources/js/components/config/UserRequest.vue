<template>
    <div>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>User</th>
                    <th>Name</th>
                    <th>Subcription Date</th> 
                    <th>Account Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in allUserRequesting" v-bind:key="row.id">
                    <td>{{ row.id }}</td>
                    <td>{{ row.user }}</td>
                    <td>{{ row.name }}</td>
                    <td>{{ row.created_at }}</td>
                    <td>{{ row.id_account_type }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    props: ['allUserRequesting'],
    data() {
        return {

        }
    }
}
</script>