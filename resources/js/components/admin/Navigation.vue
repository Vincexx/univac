<template>
    <v-app id="inspire">
      <v-navigation-drawer
        v-model="drawer"
        app
      >
      
        <v-list dense>

          <v-list-item link @click="homepage()">
            <v-list-item-action>
              <v-icon>mdi-arrow-left</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Homepage</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
          
          <v-sheet
            color="grey lighten-5"
            class="pa-7 text-center"
        >
             <v-avatar>
              <img
                src="/img/logo.png"
                alt="John"
                class="mb-1"
              >
            </v-avatar>

            <div>{{ authuser.name }}</div>
        </v-sheet>


          <router-link :to="{ name : 'dashboard'}">
              <v-list-item link>
                <v-list-item-action>
                  <v-icon>mdi-shape</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Dashboard</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
          </router-link>

          <router-link :to="{ name : 'users' }">
              <v-list-item link>
                <v-list-item-action>
                  <v-icon>mdi-account-group</v-icon>
                </v-list-item-action>
                <v-list-item-content>
                  <v-list-item-title>Users</v-list-item-title>
                </v-list-item-content>
              </v-list-item>
          </router-link>

          <router-link :to="{ name : 'campuses' }">
            <v-list-item link>
              <v-list-item-action>
                <v-icon>mdi-school</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Campuses</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </router-link>

          <router-link :to="{ name : 'programs' }">
            <v-list-item link>
              <v-list-item-action>
                <v-icon>mdi-pencil</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Programs</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </router-link>

           <router-link :to="{ name : 'others' }">
            <v-list-item link>
              <v-list-item-action>
                <v-icon>mdi-file</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Other Documents</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </router-link>

          <router-link :to="{ name : 'trash' }">
            <v-list-item link>
              <v-list-item-action>
                <v-icon>mdi-delete</v-icon>
              </v-list-item-action>
              <v-list-item-content>
                <v-list-item-title>Trash</v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </router-link>

          <v-list-item link>
            <v-list-item-action>
              <v-icon>mdi-logout</v-icon>
            </v-list-item-action>
            <v-list-item-content @click="logout">
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>
        
      </v-navigation-drawer>
    
        

      <v-app-bar
        app
        color="green"
        dark
      >
        <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
        <v-toolbar-title>Dashboard</v-toolbar-title>
      </v-app-bar>
  
      <v-main>
        <router-view
        :authUser="authuser"
        ></router-view>
      </v-main>
      <v-footer
        color="green"
        app
      >
        <span class="white--text">CvSU - IDO &copy; {{ new Date().getFullYear() }}</span>
      </v-footer>
    </v-app>
</template>
<script>
export default {
    props : ["authuser"],
    data: () => ({
        drawer: null,
    }),
    methods: {
        logout() {
            axios.post('/logout')
            .then(res => {
                window.location.href = '/';
            }).catch(err => console.log(err))
        },
        homepage() {
          window.location.href = "/"
        }
    }
}
</script>