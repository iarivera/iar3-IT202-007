<table><tr><td> <em>Assignment: </em> IT202 Milestone 2 API Project</td></tr>
<tr><td> <em>Student: </em> Ivan Rivera (iar3)</td></tr>
<tr><td> <em>Generated: </em> 12/7/2023 9:10:35 PM</td></tr>
<tr><td> <em>Grading Link: </em> <a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/iar3" target="_blank">Grading</a></td></tr></table>
<table><tr><td> <em>Instructions: </em> <ol><li>Checkout Milestone2 branch</li><li>Create a new markdown file called milestone2.md</li><li>git add/commit/push immediate</li><li>Fill in the below deliverables</li><li>At the end copy the markdown and paste it into milestone2.md</li><li>Add/commit/push the changes to Milestone2</li><li>PR Milestone2 to dev and verify</li><li>PR dev to prod and verify</li><li>Checkout dev locally and pull changes to get ready for Milestone 3</li><li>Submit the direct link to this new milestone2.md file from your GitHub prod branch to Canvas</li></ol><p>Note: Ensure all images appear properly on github and everywhere else. Images are only accepted from dev or prod, not local host. All website links must be from prod (you can assume/infer this by getting your dev URL and changing dev to prod).</p></td></tr></table>
<table><tr><td> <em>Deliverable 1: </em> Define the appropriate table or tables for your API </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the table definition SQL files</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T18.26.24Screenshot1.jpg.webp?alt=media&token=d9c88240-2031-4ef4-937c-e7d890337fff"/></td></tr>
<tr><td> <em>Caption:</em> <p>Screenshot of the table I created that has some data filled. It contains<br>fields for its id, api_id, name, type_1, optional type_2, a caught status, a<br>created timestamp and modified timestamp.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Mappings</td></tr>
<tr><td> <em>Response:</em> <p>Table CA_Pokemon has columns for id, api_id, name, type_1, optional type_2, whether a<br>Pokemon has been caught, a created timestamp and modified timestamp. &quot;api_id&quot; pulls the<br>Pokemon&#39;s corresponding id from the API. Name pulls in the corresponding Pokemon&#39;s name.&nbsp;<br>The type columns pull the Pokemon&#39;s corresponding types, type_1 must be filled, because<br>all Pokemon have at least 1 typing. Some Pokemon have a 2nd typing,<br>so type_2 accounts for that.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/33">https://github.com/iarivera/iar3-IT202-007/pull/33</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 2: </em> Data Creation Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of the Page and the Code (at least two)</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T19.26.56Screenshot2a.jpg.webp?alt=media&token=7a46fc2f-ce3a-4139-88b4-4440ea843b31"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows an attempt at creating a Pokemon, but the name for<br>the Pokemon is too short.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T19.35.42Screenshot2b.jpg.webp?alt=media&token=44fedbe6-ad41-4639-86b8-63a2bc9875a7"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot contains code for fetching the Pokemon, and valid entry data for<br>a Pokemon called Missingno which is a Psychic type with no 2nd type.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T19.39.24Screenshot2c.jpg.webp?alt=media&token=8218571b-6f7d-42b5-960a-29d7614f5089"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the result of submitting a new Pokemon. There the only flash<br>message that matters is the green, indicating a successful creation. The red flash<br>message likely appears because Missingno wasn&#39;t in the database.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Database Results</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T19.54.04Screenshot3a.jpg.webp?alt=media&token=34279bf1-e82b-45cf-b33d-c54caf923d19"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the table CA_Pokemon. This consists of data that came from<br>the API. As Pokemon that lack 2nd types, that column is blank, and<br>that they have an api_id.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T19.54.06Screenshot3b.jpg.webp?alt=media&token=79011c96-8247-4d2c-adfd-42490d4d1896"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the table CA_Pokemon. The final page shows Missingno, who was<br>manually created, because the 2nd type is labeled as None, and the lack<br>of api_id.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 3: </em> Misc Checklist</td></tr>
<tr><td> <em>Response:</em> <p>The entities are tied to the PokemonGo API and consist of their name,<br>and their corresponding number on the Pokedex. Duplicates from manually handled items cause<br>an error. Duplicates from API added items also cause an error. Currently, only<br>the Admin is able to handle the creation of entities.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/pokemon_profile.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/pokemon_profile.php</a> </td></tr>
<tr><td> <em>Sub-Task 5: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/34">https://github.com/iarivera/iar3-IT202-007/pull/34</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 3: </em> Data List Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot the list page and code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-06T19.30.09Screenshot5a.jpg.webp?alt=media&token=cd70dc34-905e-47b6-b420-3e8cb0b35d2d"/></td></tr>
<tr><td> <em>Caption:</em> <p>The list Pokemon page is an admin only page that shows 10 Pokemon<br>max. It filters by a Pokemon&#39;s name, its primary type, and whether or<br>not it was caught. Every column on the table, with the exception of<br>the &quot;caught&quot; comes from the API. Each button takes the admin to either<br>view, edit, or delete the Pokemon&#39;s info. The page uses bootstrap styling, with<br>the text at the bottom being a note for Milestone3.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-06T19.33.06Screenshot5b.jpg.webp?alt=media&token=ad3e6406-ef06-4f29-9a7f-0b87e74deab9"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows what happens if there are no results.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-07T02.22.58Screenshot5c.jpg.webp?alt=media&token=46e00609-e66d-465d-b125-eebd0732fe5d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows a filtering that displays results. The name uses regular expressions<br>for a partial match, which is any pokemon that contains the letter &quot;m&quot;<br>and is also a water type, that wasn&#39;t caught.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>Only the admin can view this page, which means they must be logged<br>in. The view, edit, and delete pages also can only be used by<br>admins. What is being shown is the Pokemon&#39;s id number, its typings, whether<br>or not the Pokemon has been caught by a user, and the action<br>buttons. The filters are name, caught, type, columns, and order. Name uses regular<br>expressions to see which Pokemon names contain a set of letters. Caught filters<br>between Pokemon who have been caught or not. Type filter&#39;s between a Pokemon&#39;s<br>primary type. Columns filters between its created and modified timestamps. Order filters either<br>in ascending or descending order.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/list_pokemon.php">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/list_pokemon.php</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/35">https://github.com/iarivera/iar3-IT202-007/pull/35</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 4: </em> View Details Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-07T20.11.12Screenshot6a.jpg.webp?alt=media&token=324183ca-3c41-4162-a583-211dad0f466e"/></td></tr>
<tr><td> <em>Caption:</em> <p>This page shows all individual cards, it also shows what happens if you<br>click an invalid card.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-07T20.11.16Screenshot6b.jpg.webp?alt=media&token=708a0458-3f55-44d4-b883-3466586ef74a"/></td></tr>
<tr><td> <em>Caption:</em> <p>An individual card, being Bulbasaur, stating whether or not Bulbasaur has been caught,<br>its types and region of origin.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>An individual Pokemon&#39;s card, provides its name, whether or not it has been<br>caught, and a brief about statement. Only the admins can edit and delete<br>links on the page. <br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/browse.php?">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/browse.php?</a> </td></tr>
<tr><td> <em>Sub-Task 4: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/35">https://github.com/iarivera/iar3-IT202-007/pull/35</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 5: </em> Edit Data Page </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshot of Page and related content/code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-07T20.33.34Screenshot7a.jpg.webp?alt=media&token=215385ae-a4f2-4f25-972d-fe0ba2744204"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is the profile page of Mr. Mime, prefilled with all his name<br>and typings. If invalid ID is detectd, suppose by putting -1 in the<br>URL, it redirects to the creation page.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-07T20.35.29Screenshot7b.jpg.webp?alt=media&token=c305f6f2-6db4-43e4-843f-1a7bca55bd29"/></td></tr>
<tr><td> <em>Caption:</em> <p>This is an example where an admin attempts to change Mr. Mime&#39;s name,<br>but falls below the 2 character minimum.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Add a direct link to this file on Heroku Prod</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/list_pokemon.php?name=Mi&type_1=psychic&caught=&order=">https://iar3-prod-8afd25d0af9e.herokuapp.com/Project/admin/list_pokemon.php?name=Mi&type_1=psychic&caught=&order=</a> </td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/35">https://github.com/iarivera/iar3-IT202-007/pull/35</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 6: </em> Delete Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of related code/evidence</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-08T01.13.47Screenshot8a.jpg.webp?alt=media&token=1d16c478-06c9-4bd4-808e-5b14e750ffb9"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the Pokemon, Missingno, being marked as caught. A flash message<br>appears saying so, and the caught column changes as well to reflect the<br>change.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-08T01.44.40Screenshot8b.jpg.webp?alt=media&token=80539295-eabe-4e25-81e3-5fb793bb9a98"/></td></tr>
<tr><td> <em>Caption:</em> <p>This screenshot shows the CA_Pokemon table after the update, as well the code.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-08T01.51.29Screenshot8c.jpg.webp?alt=media&token=0c7dfdd8-1708-44dd-a328-d9c773a8fa53"/></td></tr>
<tr><td> <em>Caption:</em> <p>This the search looking for Pokemon that have &quot;Mi&quot; in their name, that<br>are Psychic types that weren&#39;t caught before marking Missingno as caught.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-08T01.51.35Screenshot8d.jpg.webp?alt=media&token=ae982162-7f8f-47b3-bcf5-af0e4fa8a16d"/></td></tr>
<tr><td> <em>Caption:</em> <p>This the search looking for Pokemon that have &quot;Mi&quot; in their name, that<br>are Psychic types that weren&#39;t caught after marking Missingno as caught.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>Admins are the only role that can delete items. The deletion process is<br>a soft delete, in that it marks the Pokemon as caught. In Milestone<br>3, I plan to associate which user was the first to catch any<br>specific Pokemon. With a Pokemon being marked as caught, it can appear when<br>not looking for any particular filters, but when filtering by whether if a<br>Pokemon was not caught, it will no longer appear in those results.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/35">https://github.com/iarivera/iar3-IT202-007/pull/35</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 7: </em> API Handling </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> Screenshots of Code</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T20.42.08Screenshot4a.jpg.webp?alt=media&token=de682028-871d-4f7c-a8cc-d82378156747"/></td></tr>
<tr><td> <em>Caption:</em> <p>This code contains the API call. I am calling for the Pokemon&#39;s type,<br>which contains its name and typing(s).<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T20.42.09Screenshot4b.jpg.webp?alt=media&token=cdc841ac-0b97-44ab-8d21-d6363d17a46a"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code shows how the mapping shows handled translating API columns into the<br>database.<br></p>
</td></tr>
<tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-12-02T20.42.14Screenshot4c.jpg.webp?alt=media&token=e886bdd0-f5d7-448d-a45c-8ac6e68ec3d4"/></td></tr>
<tr><td> <em>Caption:</em> <p>The code shows how any duplicates are dealt with. This is done using<br>the ON DUPLICATE KEY UPDATE clause. This simply updates any duplicate&#39;s modified timestamps.<br></p>
</td></tr>
</table></td></tr>
<tr><td> <em>Sub-Task 2: </em> Explanation</td></tr>
<tr><td> <em>Response:</em> <p>The API data starts by processing the Pokemon&#39;s type(s). The mapping uses column<br>names from the API, which are set to the columns on the database.<br>The API call is triggered with a get request, and then pulls the<br>data. My goal with the API data is to have each Pokemon display<br>so users can say which Pokemon they have caught, which will be implemented<br>in Milestone 3.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> Add any related PRs for this task</td></tr>
<tr><td> <a rel="noreferrer noopener" target="_blank" href="https://github.com/iarivera/iar3-IT202-007/pull/33">https://github.com/iarivera/iar3-IT202-007/pull/33</a> </td></tr>
</table></td></tr>
<table><tr><td> <em>Deliverable 8: </em> Misc </td></tr><tr><td><em>Status: </em> <img width="100" height="20" src="https://user-images.githubusercontent.com/54863474/211707773-e6aef7cb-d5b2-4053-bbb1-b09fc609041e.png"></td></tr>
<tr><td><table><tr><td> <em>Sub-Task 1: </em> What issues did you face and overcome during this milestone?</td></tr>
<tr><td> <em>Response:</em> <p>Working with the API was confusing at first, but I did eventually figure<br>that out. Learning to use the terminal for error logging, proved used when<br>debugging problems such as mismatches in variables, when displaying items.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 2: </em> What did you find the easiest?</td></tr>
<tr><td> <em>Response:</em> <p>Managing already existing files was the easiest, as only minor changes such as<br>adding functions, and including files.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 3: </em> What did you find the hardest?</td></tr>
<tr><td> <em>Response:</em> <p>Working with making sure data was properly displayed proved to be one of<br>the most difficult parts. Learning how to debug php, was tedious, but proved<br>to be rewarding when successful.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 4: </em> Did you have to utilize any unanticipated APIs?</td></tr>
<tr><td> <em>Response:</em> <p>Currently, I have stuck only to the main API I mentioned in the<br>API research assignment. I have considered using different Pokemon APIs alongside the current<br>API, in order to have more options.<br><br></p><br></td></tr>
<tr><td> <em>Sub-Task 5: </em> Add a screenshot of your project board</td></tr>
<tr><td><table><tr><td><img width="768px" src="https://firebasestorage.googleapis.com/v0/b/learn-e1de9.appspot.com/o/assignments%2Fiar3%2F2023-11-28T04.08.25Screenshot20.jpg.webp?alt=media&token=ab1a7484-00a5-4746-9b65-5c88973115d1"/></td></tr>
<tr><td> <em>Caption:</em> <p>Project board, there are less tasks in done compared to Milestone 1, because<br>I opted to condense it into a single issue. In progress contains 3<br>items, and to do has items that largely relate to the next milestone.<br></p>
</td></tr>
</table></td></tr>
</table></td></tr>
<table><tr><td><em>Grading Link: </em><a rel="noreferrer noopener" href="https://learn.ethereallab.app/homework/IT202-007-F23/it202-milestone-2-api-project/grade/iar3" target="_blank">Grading</a></td></tr></table>