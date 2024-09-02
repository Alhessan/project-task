<template>
  <nav>
    <router-link to="/">Home</router-link> |
    <router-link to="/about">About</router-link>
  </nav>
  <router-view/>
</template>

<style lang="scss">

#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;

  a {
    font-weight: bold;
    color: #2c3e50;

    &.router-link-exact-active {
      color: #42b983;
    }
  }
}

body{
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  margin: 0;
  padding: 0;
  padding-left: 5%  ;
  padding-right: 5%;
}
// Variables
$primary-color: #3498db;
$secondary-color: #2ecc71;
$font-color: #333;
$background-color: #f4f4f4;
$border-radius: 5px;

// Mixins
@mixin flex-center {
  display: flex;
  justify-content: center;
  align-items: center;
}

// Container styles
.container {
  background-color: $background-color;
  padding: 20px;
  border-radius: $border-radius;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

// Table styles
.table {
  width: 100%;
  border-collapse: collapse;

  &__header {
    background-color: $primary-color;
    color: white;

    th {
      padding: 10px;
      text-align: left;
    }
  }

  &__body {
    tr {
      &:nth-child(even) {
        background-color: lighten($primary-color, 40%);
      }

      &:hover {
        background-color: lighten($primary-color, 50%);
      }
    }

    td {
      padding: 10px;
      border-bottom: 1px solid #ddd;
      color: $font-color;
    }
  }
}

// Button styles
.button {
  padding: 10px 20px;
  border: none;
  border-radius: $border-radius;
  color: white;
  background-color: $secondary-color;
  cursor: pointer;
  transition: background-color 0.3s ease;

  &:hover {
    background-color: darken($secondary-color, 10%);
  }
}

// Pagination styles
.pagination {
  @include flex-center;
  margin-top: 20px;

  &__item {
    margin: 0 5px;
    padding: 8px 12px;
    background-color: $primary-color;
    color: white;
    border-radius: $border-radius;
    cursor: pointer;
    transition: background-color 0.3s ease;

    &:hover {
      background-color: darken($primary-color, 10%);
    }

    &--active {
      background-color: $secondary-color;
    }
  }
}

// Search bar styles
.search-bar {
  @include flex-center;
  margin-bottom: 20px;

  input {
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: $border-radius;
    width: 100%;
    max-width: 400px;
    margin-right: 10px;
  }

  button {
    @extend .button;
  }
}

</style>
