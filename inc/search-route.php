<?php
add_action('rest_api_init', 'universityRegisterSearch');
function universityRegisterSearch()
{
    register_rest_route('university/v1','search',array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'universitySearchResults'
    ));
}

function universitySearchResults()
{
   $professors = new WP_Query(array(
       'post_type' => 'professor',
   ));

   $professorResults = [];
   while($professors->have_posts()){
       $professors->the_post();
       $professorObject = new stdClass();
       $professorObject->title = get_the_title();
       $professorObject->permalink = get_the_permalink();
       $professorObject->postType = get_post_type_object(get_post_type())->labels->singular_name;
       array_push($professorResults,$professorObject);
   }
    
   return $professorResults;
}
