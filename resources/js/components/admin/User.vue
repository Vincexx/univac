<template>
  <div>
    <v-app>
      <v-container>
        <v-card>
          <v-card-title>
            List of Users
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
          </v-card-title>
          <v-data-table
            :headers="headers"
            :items="users"
            :search="search"
          >
          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
  </div>
</template>

<script>
  export default {
    data () {
      return {
        search: '',
        users : [],
        headers: [
          {
            text: 'Name',
            align: 'start',
            value: 'name',
          },
          { text: 'Email', value: 'email' },
          { text: 'Role', value: 'role' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        
      }
    },
    created() {
      this.fetchUsers();
    },
    methods: {
      fetchUsers() {
        axios.get('/api/users')
        .then(res => this.users = res.data)
        .catch(err => console.log(err))
      }
    } 
  }
</script>