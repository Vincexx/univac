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
          <v-btn class="mx-2 my-2" fab dark color="indigo" @click.stop="showDialog=true">
            <v-icon dark>mdi-plus</v-icon>
          </v-btn>
        
          <v-card-title>
            List of Campuses
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
            :items="campuses"
            :search="search"
          >

          <template v-slot:item.image="{ item }">
              <div>
                <v-img :src="'/storage/' + item.image" alt="image" width="100px" height="60px" class="m-2"></v-img>
              </div>
          </template>
      
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click.stop="showDialog=true, edit=true, campus_id=item.id, editPost(item.id)"
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
                  @click.stop="deleteDialog = true, campus_id = item.id"
                  
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
    <AddCampus :showDialog="showDialog" :authUser="authUser" :edit="edit" :campus1="campus1" />
    <DeleteCampus :deleteDialog="deleteDialog" :campus_id="campus_id" :authUser="authUser" />
  </div>
</template>

<script>
  import AddCampus from "./children/AddCampus"
  import DeleteCampus from "./children/DeleteCampus"
  export default {
    mounted (){

      this.$on('hide_add_dialog', () => {
          this.campus1.name = ''
          this.campus1.description = ''
          this.campus1.image = ''
          this.showDialog = false
          this.edit = false
      })
      
      this.$on('added_campus', (message) => {
          this.message = message
          this.snackbar = true
          this.fetchCampuses()
          this.showDialog = false 
      })

      this.$on('hide_delete_dialog', () => {
          this.deleteDialog = false 
          
      })

      this.$on('campus_deleted', (message) => {
          this.message = message
          this.snackbar = true
          this.fetchCampuses()
          this.deleteDialog = false 
      })

      this.$on('campus_updated', (message) => {
          this.edit = false
          this.message = message
          this.snackbar = true
          this.fetchCampuses()
          this.showDialog = false 
      })

    },
    components : {
      AddCampus,
      DeleteCampus
    },
    props : ["authUser"],
    data () {
      return {
        edit : false,
        config : { 
            'headers': { 
              'Authorization': 'Bearer ' + this.authUser.api_token,
              'Accept' : 'application/json',
            } 
        },
        snackbar: false,
        message: '',
        timeout: 3000,
        campus_id : '',
        showDialog : false,
        deleteDialog : false,
        search: '',
        campuses : [],
        campus1 : {},
        headers: [
           { text: 'Image', value: 'image' },
           { text: 'Colleges/Campuses', value: 'name' },
          { text: 'Actions', value: 'actions', sortable: false },
        ],
        
      }
    },
    created() {
      this.fetchCampuses();
    },
    methods: {
      fetchCampuses() {
        axios.get('/api/campuses', this.config)
        .then(res => this.campuses = res.data)
        .catch(err => console.log(err))
      },
      editPost(id) {
        axios.get('/api/campuses/' + id, this.config)
        .then(res => {
            this.campus1 = res.data
        })
        .catch(err => console.log(err))

      }
     
    } 
  }
</script>