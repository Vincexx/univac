<template>
  <div>
    <v-app>

      <div class="text-center">
        <v-snackbar
          v-model="snackbar"
          :timeout="timeout"
        >
          {{ message }}

          <template v-slot:action="{ attrs }">
            <v-btn
              color="blue"
              text
              v-bind="attrs"
              @click="snackbar = false"
            >
              Close
            </v-btn>
          </template>
        </v-snackbar>
      </div>

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

          <v-btn class="mx-2 my-2" fab dark color="indigo">
              <v-icon dark @click.stop="showDialog = true">mdi-plus</v-icon>
            </v-btn>

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
                  @click="editUser(item.id), edit=true, showDialog=true"
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
                  @click="deleteUser(item.id)"
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
    <AddUser :authUser="authUser" :showDialog="showDialog" :user1="user" :edit="edit"></AddUser>
  </div>
</template>

<script>
  import AddUser from "./children/AddUser"
  export default {
    mounted () {
      this.$on('hide_dialog', () => {
          this.showDialog = false
          this.edit = false
      })

      this.$on('user_added', (message) => {
          this.snackbar = true
          this.edit = false
          this.message = message
          this.fetchUsers()
          this.showDialog = false
      })

      this.$on('user_updated', (message) => {
          this.snackbar = true
          this.message = message
          this.edit = false
          this.fetchUsers()
          this.showDialog = false
      })

    },
    components : {
      AddUser
    },
    props : ['authUser'],
    data () {
      return {
        edit : false,
        snackbar: false,
        message: '',
        timeout: 3000,
        showDialog : false,
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        search: '',
        users : [],
        user : {
          name : '',
          email : '',
          role : '',
        },
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
        axios.get('/api/users', this.config)
        .then(res => this.users = res.data)
        .catch(err => console.log(err))
      },
      deleteUser(id) {
        axios.delete('/api/users/' + id ,this.config)
        .then(res => {
          this.snackbar = true
          this.message = res.data.message
          this.fetchUsers()
        })
        .catch(err => console.log(err))
      },
      editUser(id) {
        axios.get('/api/users/' + id, this.config)
        .then(res => this.user = res.data)
        .catch(err => console.log(err))
      }
    } 
  }
</script>