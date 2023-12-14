<table><tr><td> <em>Assignment: </em> IT202 Milestone 3 API Project</td></tr>
<tr><td> <em>Student: </em> Ivan Rivera (iar3)</td></tr>
<tr><td> <em>Generated: </em> 12/13/2023 10:45:58 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/iar3" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone3 branch</li><li>Create a new markdown file called milestone3.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone3.md</li><li>Add/commit/push the changes to Milestone3</li><li>PR Milestone3 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes just to be up to date</li><li>Submit the direct link to this new milestone3.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> API Data Association </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Consider how your API data will be associated with a user</td></tr>
<tr><td> <em>Response:</em> <p>The API data can be related through which Pokemon a user has caught,<br>and which Pokemon and Pokemon type a user has liked. The API data<br>is that related to users is the Pokemon themselves. Because my project is<br>a community Pokedex, seeing which Pokemon have been caught matters. With users, we<br>can associate, which user was the first to catch a Pokemon, and in<br>their card, it will state which user was the first to catch the<br>Pokemon.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Handling Data Changes</td></tr>
<tr><td> <em>Response:</em> <div>The association changes that a Pokemon is tied to the user who caught<br>them. This is done manually, a Catch request is made by user, this<br>a POST request were the user writes a request to have a Pokemon<br>marked as caught. Once admin accepts or rejects the request, users see the<br>latest version of the data.</div><br></td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Handle the association of data to a user </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Which option did you need to do to handle the association of data?</td></tr>
<tr><td> <em>Response:</em> <p>I used option 2, where an admin handles data of users. The admin<br>manages requests, accept or reject the requests that users make to mark Pokemon<br>they have caught.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add screenshots of the updated/created pages related to associating data with the user (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.45.11Screenshot1.jpg.webp?alt=media&token=05fc7cdd-00c2-453f-9d86-201b582d9e29"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the Catch requests, that admins have. Association is shown by<br>the requestor&#39;s id, which is the user&#39;s id.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.48.39Screenshot1b.jpg.webp?alt=media&token=8117280e-5089-4c58-b684-c42aef0c88ea"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the code for how requests work, along with the comment<br>that explains what is happening at very high level. The first thing code<br>checks is if the user viewing this page is an admin. If not,<br>the user is sent back to the home page. Otherwise, the user&#39;s id<br>is fetched to be set as the processor id, when requests are processed.<br>Intents are checked for in the Intents table, and inserted into a table<br>to be rendered in a render table function.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.51.11Screenshot1c.jpg.webp?alt=media&token=63dbe4a2-f8ff-4781-8778-45d93f0842d1"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows an individual request, and its basic info. A text box<br>for the processor to fill out is present, along with options that accept<br>or reject requests, or go back to the requests page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.52.53Screenshot1d.jpg.webp?alt=media&token=675a7cab-88f1-4b44-a62d-d45c11d9a4ad"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the query that happens when everything is processed correctly. It<br>inserts the id values of the Pokemon, User, and Request, into a table<br>that defines shows ownership. The statement is executed, and if no errors occur,<br>the Pokemon&#39;s status is updated on the Pokemon table. If any errors occur,<br>the statements are rolled back to prevent an errors from happening if queries<br>are executed without them.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.52.57Screenshot1f.jpg.webp?alt=media&token=6fa96796-d3c1-41aa-b035-6e4c956cb050"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the how the page is rendered. The information is pulled<br>using a POST request. Further information is pulled from the $request and is<br>rendered using the render_input function. Its type determines how the information is rendered,<br>further parameters determine what is rendered. The buttons are rendered, and when clicked<br>trigger the code to begin executing the query.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-13T23.53.00Screenshot1g.jpg.webp?alt=media&token=5489c72c-5271-4de1-b8fc-8cd9a03bd2d4"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what is done before any queries are executed. But before<br>that, the page checks if the user is an admin. If so, it<br>builds the query to update the status of catch request, to reflect that<br>it is pending. Depending on what action is performed, the status is set<br>either as approved or rejected. The id of the intent is pulled, and<br>the checks are made before the updates to user association are made. Is<br>the query violating an foreign key restrictions, is the Pokemon valid, and is<br>the requestor valid? If either one of these parameters are not valid, then<br>the errors are logged, and the query is rolled back.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any Heroku prod links to pages that would trigger entity to user association</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/requests.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/requests.php</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/request.php?id=2">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/request.php?id=2</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/44">https://github.com/iarivera/iar3-IT202-007/pull/44</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/45">https://github.com/iarivera/iar3-IT202-007/pull/45</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/46">https://github.com/iarivera/iar3-IT202-007/pull/46</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Logged in user’s associated entities page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What is the data that's associated with the user?</td></tr>
<tr><td> <em>Response:</em> <p>Data that is associated with a user, includes Pokemon a user has and<br>Catch requests they have made. Catch requests as both users admins can view<br>them on their respective sides. A user can view the Pokemon caught they<br>have, but the card doesn&#39;t properly display exactly which Pokemon the user caught.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the logged in user's entities associated with them  (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.20.20Screenshot2a.jpg.webp?alt=media&token=f924e06e-bdc3-4cff-8778-d2a154302b72"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows a user&#39;s requests. It lists if the request has been<br>completed, and which Pokemon is attempting to be caught.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.20.25Screenshot2b.jpg.webp?alt=media&token=93d54860-3db2-42d1-a29e-4e963e5766e8"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the code for the user&#39;s requests. It pulls the users requests<br>from the Intents table, and the displays them. <br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.35.03Screenshot2c.jpg.webp?alt=media&token=8a5ff621-56d0-4bac-a7be-f822474e5781"/></td></tr>
<tr><td> <em>Caption:</em> <p>This shows the user&#39;s caught Pokemon. It correctly displays the amount of Pokemon<br>caught, but doesn&#39;t properly display which Pokemon was caught. The admin is able<br>to view all associations properly.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.35.09Screenshot2d.jpg.webp?alt=media&token=6d72cd8e-e04b-4a58-9539-4ba3a44304cb"/></td></tr>
<tr><td> <em>Caption:</em> <p>This code shows the page is rendering the caught Pokemon. It searches for<br>Pokemon, and filters based on what Pokemon the user was caught. The problem<br>may be how the render function isn&#39;t taking in account data, such as<br>the user association, and the caught Pokemon&#39;s name.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where the logged in user has their entities listed</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/my_requests.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/my_requests.php</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/caught_pokemon.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/caught_pokemon.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/44">https://github.com/iarivera/iar3-IT202-007/pull/44</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> All Users association page (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Describe/Explain the purpose of this page from your project perspective</td></tr>
<tr><td> <em>Response:</em> <p>The all users association page purpose is to keep track of which users<br>are sending catch requests for the Pokemon they have caught for the Pokedex.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Show screenshots of the entity data associated with many users (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.38.20Screenshot1a.jpg.webp?alt=media&token=57b88a9e-668c-46b6-bb68-eb46ab5cc590"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the Catch requests, that admins have. Association is shown by<br>the requestor&#39;s id, which is the user&#39;s id. The information can be viewed<br>individually by clicking the view button.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T00.38.26Screenshot1b.jpg.webp?alt=media&token=ad5f99fc-e268-4779-ad4c-61fc0fb1eead"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the code for how requests work, along with the comment<br>that explains what is happening at very high level. The first thing code<br>checks is if the user viewing this page is an admin. If not,<br>the user is sent back to the home page. Otherwise, the user&#39;s id<br>is fetched to be set as the processor id, when requests are processed.<br>Intents are checked for in the Intents table, and inserted into a table<br>to be rendered in a render table function.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) where entities associated to many users can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/requests.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/requests.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/44">https://github.com/iarivera/iar3-IT202-007/pull/44</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/45">https://github.com/iarivera/iar3-IT202-007/pull/45</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Create a page that shows data not associated with any user (Note: This will likely be an admin page and is not the same as the previous item) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Show screenshots of the page showing entities not associated with anyone (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T01.43.07Screenshot5a.jpg.webp?alt=media&token=38654b36-de49-4546-8f41-b78f7df6d71e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page is supposed to be pulling in the Pokemon that don&#39;t have<br>the caught status, but it seems to be ignoring the status column.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T01.43.08Screenshot5b.jpg.webp?alt=media&token=c0d2db5f-3317-4eb5-95fc-1d8f414d3072"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code, in theory, is supposed to be searching for Pokemon who are<br>labeled as &quot;Not Caught&quot; Once all those Pokemon are found, a foreach statement<br>is used to render each Pokemon. If no  Pokemon are found, a<br>statement stating that all Pokemon were caught is displayed.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add Heroku Prod links to the page(s) where unassociated entities can be seen</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/not_caught_pokemon.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/not_caught_pokemon.php</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/44">https://github.com/iarivera/iar3-IT202-007/pull/44</a> </td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/45">https://github.com/iarivera/iar3-IT202-007/pull/45</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Admin can associate any entity with any users (Note: This may be a form on an existing association page if you rather not have a separate page for this) </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Add screenshots showing evidence of the checklist items (include code screenshots)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T03.39.19Screenshot6a.jpg.webp?alt=media&token=327d813a-0588-4d5d-bf56-e28d6929816f"/></td></tr>
<tr><td> <em>Caption:</em> <p>The Pokemon was marked as caught, but the plan was when using the<br>delete option, the admin would be redirected to a page, that would be<br>selecting which user caught the Pokemon that is being &quot;deleted.&quot; This would be<br>setting an association, without any requests.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-14T03.39.56Screenshot6b.jpg.webp?alt=media&token=26d2bd2d-9ad6-4123-9621-0d9bc6c3533b"/></td></tr>
<tr><td> <em>Caption:</em> <p>The logic of the current state of the code, just checks if the<br>Pokemon is valid, then updates its status to be caught. The comment at<br>the top of the file, states the plan I had.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explain the code logic for this page</td></tr>
<tr><td> <em>Response:</em> <p>This wasn&#39;t tackled, but the idea I had was taking the disable_pokemon_profile.php file,<br>and changing it from an a link that simply marks a Pokemon as<br>caught to a page, that would have a list of which users to<br>associate the Pokemon to. The query to update tables likely would have been<br>very similar to the query used to handle requests, minus the handling of<br>an intent id. Currently, what happens is the Pokemon is marked as Caught,<br>but no association occurs.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add Heroku Prod links to the page(s) related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/disable_pokemon_profile.php?id=2">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/disable_pokemon_profile.php?id=2</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Include any PRs related to this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/45">https://github.com/iarivera/iar3-IT202-007/pull/45</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> Reflection </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Document any issues/struggles</td></tr>
<tr><td> <em>Response:</em> <p>The largest struggle I had was making the requests work. Even then, there<br>are still some issues. Fixing it began by realizing, that my requests didn&#39;t<br>need to be that complex. As the only intent was catching the Pokemon,<br>that helped to simplify how I was tackling it. Looking through the tables<br>to make sure foreign keys were properly associated, and making sure my the<br>query was referencing columns that existed, was tedious, but reminded me how important<br>attention to detail matters when it comes to programming. <br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> Highlight any favorite topics</td></tr>
<tr><td> <em>Response:</em> <p>Working with the databases proved to be challenging, but was incredibly satisfying when<br>successful. Seeing how linking tables worked, and how setting up queries worked with<br>the data to achieve a desired result, particularly with getting catch requests to<br>work. Fixing the foreign key violation was challenging, largely due to my inexperience<br>with SQL. It took careful reading of my query and the names of<br>the columns in each tables to make sure the requests were actually being<br>approved or denied.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Overall how do you feel you did with the project and meeting requirements</td></tr>
<tr><td> <em>Response:</em> <p>The project was very fun, despite all the shortcomings. Meeting the bare minimum<br>for requirements was incredibly easy, Going the extra mile, and making everything work,<br>proved to be tough. My lack of understanding of concepts was a major<br>setback, but I was able to make the core pieces of the project<br>work.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Summarize your experience per the checklist items</td></tr>
<tr><td> <em>Response:</em> <div>I had no development experience in the context of a project, so working<br>with a time limit and milestones was new to me.&nbsp; <br></div><div>I can definitely<br>say, that was an experience of the dos and don'ts when working a<br>project. Do make commits clear and concise, don't spread yourself thin (in this<br>case, focus on one task at time). This class provided a great intro<br>to API usage, version control, frontend, and backend development, which will prove to<br>be very useful for when I take CS 490, CS 491, and eventually<br>join the work force.<br></div><div>There are three major things I would do differently, take<br>advantage of how accessible the professor is, especially with office hours, CAREFULLY reading<br>the lessons, and better management of my time. There were some questions and<br>problems I had that could have been solved much more quickly if I<br>had simply read the lesson notes or asked Professor Toegel a question. Better<br>management of my time would have been useful because, especially in Milestone 3,<br>I largely neglected work for other classes.<br></div><br></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-3-api-project/grade/iar3" target="_blank">Grading</a></td></tr></table>