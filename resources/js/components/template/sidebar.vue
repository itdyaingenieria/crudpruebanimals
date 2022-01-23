<template>
  <div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
      <div class="sidebar-header">
        <img src="/images/logodark2.png" alt srcset />
      </div>
      <div class="sidebar-menu">
        <ul class="menu">
          <li class="sidebar-title">Main Menu</li>

          <router-link to="*" v-slot="{ href,navigate, isActive, isExactActive }" custom>
            <li class="sidebar-item" :class="[isActive && 'active', isExactActive && '']">
              <a :href="href" @click="navigate" class="sidebar-link">
                <i data-feather="user" width="20"></i>
                <span>Dashboard</span>
              </a>
            </li>
          </router-link>
          <li class="sidebar-title">Master</li>
          <router-link to="/animales" v-slot="{ href,navigate, isActive, isExactActive }" custom>
            <li class="sidebar-item" :class="[isActive && 'active', isExactActive && '']">
              <a :href="href" @click="navigate" class="sidebar-link">
                <i data-feather="user" width="20"></i>
                <span>Animales</span>
              </a>
            </li>
          </router-link>
          <router-link to="/corrales" v-slot="{ href,navigate, isActive, isExactActive }" custom>
            <li class="sidebar-item" :class="[isActive && 'active', isExactActive && '']">
              <a :href="href" @click="navigate" class="sidebar-link">
                <i data-feather="figma" width="20"></i>
                <span>Corrales</span>
              </a>
            </li>
          </router-link>
          <router-link to="/reportes" v-slot="{ href,navigate, isActive, isExactActive }" custom>
            <li class="sidebar-item" :class="[isActive && 'active', isExactActive && '']">
              <a :href="href" @click="navigate" class="sidebar-link">
                <i data-feather="archive" width="20"></i>
                <span>Reportes</span>
              </a>
            </li>
          </router-link>
        </ul>
      </div>
      <button class="sidebar-toggler btn x">
        <i data-feather="x"></i>
      </button>
    </div>
  </div>
</template>
