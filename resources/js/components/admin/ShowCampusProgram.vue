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

        <v-btn to="/admin/campuses" class="mb-2" color="orange darken-2" dark>
            <v-icon dark left>mdi-arrow-left</v-icon>Back
        </v-btn>

        <v-card>
          <v-card-title>
            
            {{ campus }}
            <v-spacer></v-spacer>
            <v-text-field
              v-model="search"
              append-icon="mdi-magnify"
              label="Search"
              single-line
              hide-details
            ></v-text-field>
            
          </v-card-title>      

          <v-btn class="mx-2 my-2" fab dark color="indigo" @click.stop="showDialog = true">
            <v-icon dark>mdi-plus</v-icon>
          </v-btn>

          <v-data-table
            :headers="headers"
            :items="campusPrograms"
            :search="search"
          >
          
           <template v-slot:item.actions="{ item }">
              <v-icon
                  small
                  class="mr-2"
                  color="primary"
                  @click="showDialog = true, editProgram(item.id), edit=true"
              >
                  mdi-pencil
              </v-icon>

              <v-icon
                  color="red"
                  small
                  @click="deleteProgram(item.id)"
              >
                  mdi-delete
              </v-icon>

          </template>
          
          </v-data-table>
        </v-card>
      </v-container>
    </v-app>
    <AddCampusProgram :showDialog="showDialog" :campus_id="id" :edit="edit" :campusProgram1="campusProgram1" />
  </div>
</template>

<script>
  import AddCampusProgram from '../admin/children/AddCampusProgram'
  export default {
    mounted() {
      this.$on('hideDialog', () => {
        this.showDialog = false
      })

      this.$on('programpercampus_added', (message) => {
        this.message = message
        this.snackbar = true
        this.fetchCampusPrograms()
        this.showDialog = false
      })
      
    },
    components : {
      AddCampusProgram
    },
    props : ['id', 'campus'],
    data () {
      return {
        edit : false,
        snackbar: false,
        message: '',
        timeout: 3000,
        showDialog : false,
        search: '',
        headers: [
        { text: 'Name of Program', value: 'name' },
        { text: 'Level', value: 'level' },
        { text: 'Validity', value: 'validity' },
        { text: 'Link', value: 'link' },
        { text: 'Actions', value: 'actions', sortable: false },
        ],
        campusPrograms : [],
        campusProgram1 : {
          'name' : '',
          'level' : '',
          'validity' : '',
          'link' : '',
        }
      }
    },
    created() {
      this.fetchCampusPrograms()
    },
    methods : {
      fetchCampusPrograms() {
        axios.get('/api/campuses/' + this.id + '/programs')
        .then(res => this.campusPrograms = res.data)
        .catch(err => console.log(err))
      },
      deleteProgram(id) {
        axios.delete('/api/programs-per-campuses/' + id)
        .then(res => {
          this.snackbar = true
          this.message = "Program deleted successfully."
          this.fetchCampusPrograms()
        })
        .catch(err => console.log(err))
      },
      editProgram(id){
        axios.get('/api/programs-per-campuses/' + id)
        .then(res => {
          this.campusProgram1 = res.data
        })
        .catch(err => console.log(err))
      }
    }
 
  }
</script>