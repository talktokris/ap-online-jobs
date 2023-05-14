<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">  
        <div class="caption-fix text-center flex-box">
                <div>
                    <h1>Meet the staff, see into the heart of companies, get inspired</h1>
                    <p>Explore
                        <span class="text-warning"> Thousands of Jobs </span> arround you
                        <br> with simple search
                    </p>
            
                    <form class="form-inline" method="post" id="form1" action="index.php">
                        <div class="form-group">
                            <input type="text" class="form-control form-changer search-box" name="jobs_categories" id="jobs_categories" placeholder="Find Jobs">
                            <a href="#" class="btn btn-warning search-box-submit" onclick="document.getElementById('form1').submit();">Search</a>
                            <br />
                        </div> 
                    </form>
                </div>
            </div>  
    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        <div class="item active">
            <img src="{{asset('images/slide1.jpg')}}" alt="...">
            <div class="carousel-caption">
            
            </div>
        </div>
        <div class="item">
            <img src="{{asset('images/slide2.jpg')}}" alt="...">
            <div class="carousel-caption">
                
            </div>
        </div>
        <div class="item">
            <img src="{{asset('images/slide3.jpg')}}" alt="...">
            <div class="carousel-caption">
                
            </div>
        </div>
    </div>
    
    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>