from .models import *
from django.views.generic import *



class PostListView(ListView):
    model = Post


class PostDetailView(DetailView):
    model = Post    
