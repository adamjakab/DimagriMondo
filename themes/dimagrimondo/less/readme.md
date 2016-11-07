Theme
=====
This is a theme of third level based on Mekit based on Bootstrap.


Vertical spacing
----------------
.margin-b-0   { .margin-b(0);    }
.margin-b-025 { .margin-b(0.25); }
.margin-b-05  { .margin-b(0.5);  }
.margin-b-1   { .margin-b(1);    }
.margin-b-15  { .margin-b(1.5);  }
.margin-b-2   { .margin-b(2);    }
.margin-b-4   { .margin-b(4);    }
.margin-b-6   { .margin-b(6);    }
.margin-b-8   { .margin-b(8);    }
.margin-b-10  { .margin-b(10);   }

.margin-t-0   { .margin-t(0);    }
.margin-t-025 { .margin-t(0.25); }
.margin-t-05  { .margin-t(0.5);  }
.margin-t-1   { .margin-t(1);    }
.margin-t-15  { .margin-t(1.5);  }
.margin-t-2   { .margin-t(2);    }
.margin-t-4   { .margin-t(4);    }
.margin-t-6   { .margin-t(6);    }
.margin-t-8   { .margin-t(8);    }
.margin-t-10  { .margin-t(10);   }

.margin-v-0   { .margin-v(0);    }
.margin-v-025 { .margin-v(0.25); }
.margin-v-05  { .margin-v(0.5);  }
.margin-v-1   { .margin-v(1);    }
.margin-v-15  { .margin-v(1.5);  }
.margin-v-2   { .margin-v(2);    }
.margin-v-4   { .margin-v(4);    }
.margin-v-6   { .margin-v(6);    }
.margin-v-8   { .margin-v(8);    }
.margin-v-10  { .margin-v(10);   }


Horizontal spacing
-------------------
.margin-xs-r-0 { .margin-r(0); }
.margin-xs-r-1 { .margin-r(1); }
.margin-xs-r-2 { .margin-r(2); }
.margin-xs-r-4 { .margin-r(4); }

.margin-xs-l-0 { .margin-l(0); }
.margin-xs-l-1 { .margin-l(1); }
.margin-xs-l-2 { .margin-l(2); }
.margin-xs-l-4 { .margin-l(4); }

.margin-xs-h-0 { .margin-h(0); }
.margin-xs-h-1 { .margin-h(1); }
.margin-xs-h-2 { .margin-h(2); }
.margin-xs-h-4 { .margin-h(4); }

@media(min-width: @screen-sm){
  .margin-sm-r-0 { .margin-r(0); }
  .margin-sm-r-1 { .margin-r(1); }
  .margin-sm-r-2 { .margin-r(2); }
  .margin-sm-r-4 { .margin-r(4); }

  .margin-sm-l-0 { .margin-l(0); }
  .margin-sm-l-1 { .margin-l(1); }
  .margin-sm-l-2 { .margin-l(2); }
  .margin-sm-l-4 { .margin-l(4); }

  .margin-sm-h-0 { .margin-h(0); }
  .margin-sm-h-1 { .margin-h(1); }
  .margin-sm-h-2 { .margin-h(2); }
  .margin-sm-h-4 { .margin-h(4); }
}

@media(min-width: @screen-md){
  .margin-md-r-0 { .margin-r(0); }
  .margin-md-r-1 { .margin-r(1); }
  .margin-md-r-2 { .margin-r(2); }
  .margin-md-r-4 { .margin-r(4); }

  .margin-md-l-0 { .margin-l(0); }
  .margin-md-l-1 { .margin-l(1); }
  .margin-md-l-2 { .margin-l(2); }
  .margin-md-l-4 { .margin-l(4); }

  .margin-md-h-0 { .margin-h(0); }
  .margin-md-h-1 { .margin-h(1); }
  .margin-md-h-2 { .margin-h(2); }
  .margin-md-h-4 { .margin-h(4); }
}

@media(min-width: @screen-lg){
  .margin-lg-r-0 { .margin-r(0); }
  .margin-lg-r-1 { .margin-r(1); }
  .margin-lg-r-2 { .margin-r(2); }
  .margin-lg-r-4 { .margin-r(4); }

  .margin-lg-l-0 { .margin-l(0); }
  .margin-lg-l-1 { .margin-l(1); }
  .margin-lg-l-2 { .margin-l(2); }
  .margin-lg-l-4 { .margin-l(4); }

  .margin-lg-h-0 { .margin-h(0); }
  .margin-lg-h-1 { .margin-h(1); }
  .margin-lg-h-2 { .margin-h(2); }
  .margin-lg-h-4 { .margin-h(4); }
}

TEXT ALIGNMENTS
----------------

@media(max-width: @screen-xs-max){
  .text-xs-center {text-align: center;}
  .text-xs-left   {text-align: left;}
  .text-xs-right  {text-align: right;}
}

@media(min-width: @screen-sm) and (max-width: @screen-sm-max){
  .text-sm-center {text-align: center;}
  .text-sm-left   {text-align: left;}
  .text-sm-right  {text-align: right;}
}

@media(min-width: @screen-md) and (max-width: @screen-md-max){
  .text-md-center {text-align: center;}
  .text-md-left   {text-align: left;}
  .text-md-right  {text-align: right;}
}

@media(min-width: @screen-lg){
  .text-lg-center {text-align: center;}
  .text-lg-left   {text-align: left;}
  .text-lg-right  {text-align: right;}
}



TYPO
----
body{
  -webkit-font-smoothing: antialiased;
}

.text-uppercase{
  text-transform: uppercase;
}

.text-inherit{
  text-transform: inherit;
}

.text-lowercase{
  text-transform: lowercase;
}

.text-italic{
  font-style: italic;
}

.text-max-width{
  max-width: 750px;
  margin-left: auto;
  margin-right: auto;
}

.large{
  font-size: @font-size-large;
}