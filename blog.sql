PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
DROP TABLE IF EXISTS `user`;
DROP TABLE IF EXISTS `post`;

CREATE TABLE `user` (
  -- Note that storing passwords in plaintext like this is very, very bad.
  -- But we'll address that issue later.
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  email TEXT UNIQUE NOT NULL,
  password TEXT NOT NULL,
  firstName TEXT NOT NULL,
  lastName TEXT NOT NULL,
  profile TEXT NOT NULL
);

INSERT INTO "user" VALUES(1,'nobody@nowhere.com','v@larM0rghul1s','Arya','Stark','I am the third child and second daughter of Lord Eddard Stark and Lady Catelyn Stark. I am the heir of House Stark under the reign of my sister, Sansa, the Queen in the North, and heir to the Kingdom of the North.');
INSERT INTO "user" VALUES(2,'ironborn@pyke.com','!r0nBorn','Theon','Greyjoy','Theon was the youngest son of Lord Balon and Lady Alannys Greyjoy. Balon is the head of House Greyjoy and Lord of the Iron Islands. The Iron Islands are one of the constituent regions of the Seven Kingdoms and House Greyjoy is one of the Great Houses of the realm. House Greyjoy rule the region from their seat at Pyke and Balon also holds the title Lord Reaper of Pyke.');
INSERT INTO "user" VALUES(3,'alwayspayshisdebts@casterlyrock.com','th3ImpR0cks','Tyrion','Lannister','Tyrion Lannister is the youngest son of Joanna Lannister and Lord Tywin Lannister. Tywin was the head of House Lannister, the richest man in the Seven Kingdoms and Lord Paramount of the Westerlands. The Westerlands are one of the constituent regions of the Seven Kingdoms and House Lannister of Casterly Rock is one of the Great Houses of the realm. He is the younger brother of Jaime and Cersei Lannister. His mother Joanna Lannister died giving birth to him. His father and sister blame Tyrion for the death.

He is a dwarf, causing him problems and persecution. His size has led him to being referred to derisively by various names, such as "The Imp" and "The Halfman". This is mitigated by his intellect and his family''s wealth and power. Had an infant with dwarfism like Tyrion been born a commoner, he''d have simply been left out in the woods to die. However, Tyrion was born into a powerful noble House, and was therefore spared. Even though his father doesn''t think much of him, he has had the benefits of being raised with wealth and education, and is expected to lead his life as a credit to the Lannister name.[4] He is committed to the good of both his House, and since Cersei married King Robert Baratheon, his family''s continued hold on the throne.');
INSERT INTO "user" VALUES(4,'todd.whittaker@franklin.edu','NicePassword','Todd','Whittaker','Department Chair, Computer and Information Sciences
Program Chair, BS in Information Technology
Program Chair, BS in Cybersecurity

Todd Whittaker currently serves as the Department Chair for Computer and Information Sciences, Program Chair for Information Technology, and Program chair for Cybersecurity at Franklin University. He has more than 25 years’ experience in computer related fields and has previously held positions as an associate professor at DeVry University, software engineer at Battelle Memorial Institute, and UNIX systems administrator at the University of Akron. He has extensive knowledge of object-oriented programming languages, design patterns, development processes, systems administration and network administration, information security, and technology education. Todd is responsible for a number of courses in the Computer Science, Information Technology, Cybersecurity, and Web Development majors. When not writing about himself in the third person, he enjoys spending time with his wife and children, and teaching in a small home group Bible study.');

CREATE TABLE `post` (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
  title VARCHAR(255) NOT NULL,
  content TEXT NOT NULL,
  datestamp DATETIME NOT NULL,
  tags VARCHAR(255) NOT NULL,
  user_id INTEGER NOT NULL,
  CONSTRAINT fk_user_id
    FOREIGN KEY (user_id)
    REFERENCES user(id)
    ON DELETE CASCADE
);

INSERT INTO "post" VALUES(1,'A first blog post','The emergence and growth of blogs in the late 1990s coincided with the advent of web publishing tools that facilitated the posting of content by non-technical users who did not have much experience with HTML or computer programming. Previously, a knowledge of such technologies as HTML and File Transfer Protocol had been required to publish content on the Web, and early Web users therefore tended to be hackers and computer enthusiasts. In the 2010s, the majority are interactive Web 2.0 websites, allowing visitors to leave online comments, and it is this interactivity that distinguishes them from other static websites.[2] In that sense, blogging can be seen as a form of social networking service. Indeed, bloggers do not only produce content to post on their blogs, but also often build social relations with their readers and other bloggers.[3] However, there are high-readership blogs which do not allow comments.

From: https://en.wikipedia.org/wiki/Blog','2019-06-10 09:15:00','first boring',4);
INSERT INTO "post" VALUES(2,'A second blog post','A blog (a truncation of "weblog")[1] is a discussion or informational website published on the World Wide Web consisting of discrete, often informal diary-style text entries (posts). Posts are typically displayed in reverse chronological order, so that the most recent post appears first, at the top of the web page. Until 2009, blogs were usually the work of a single individual,[citation needed] occasionally of a small group, and often covered a single subject or topic. In the 2010s, "multi-author blogs" (MABs) emerged, featuring the writing of multiple authors and sometimes professionally edited. MABs from newspapers, other media outlets, universities, think tanks, advocacy groups, and similar institutions account for an increasing quantity of blog traffic. The rise of Twitter and other "microblogging" systems helps integrate MABs and single-author blogs into the news media. Blog can also be used as a verb, meaning to maintain or add content to a blog.

From https://en.wikipedia.org/wiki/Blog','2019-06-10 12:15:00','second wikipedia',4);
INSERT INTO "post" VALUES(3,'Lorem Ipsum','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc maximus ex a massa luctus posuere. Nullam iaculis nibh ut dui posuere feugiat. Quisque consectetur a nisl at dictum. Suspendisse feugiat erat neque, et scelerisque libero ultrices ut. Duis lobortis felis at lorem scelerisque iaculis. Quisque sit amet quam eget tellus sodales finibus nec quis enim. Nunc nulla leo, hendrerit sed est vel, porttitor sollicitudin massa. Aenean porta mi pharetra vulputate consequat. Donec eget tincidunt nisl. Suspendisse potenti. Ut nisi enim, commodo sit amet nibh ac, laoreet blandit urna.

Phasellus eu tortor ac sapien lobortis dictum imperdiet sed lectus. Integer feugiat urna bibendum lacus consequat fringilla. Maecenas a metus convallis, dictum felis at, tincidunt quam. Fusce non magna sit amet mi bibendum ullamcorper ut vel elit. Duis vitae congue diam. Quisque in ex sit amet elit tempor dapibus eget et dolor. Sed commodo risus eu nulla interdum, sit amet aliquet libero vulputate. Maecenas efficitur in nibh sed lacinia. Duis malesuada scelerisque odio, quis luctus ante egestas vel. Nunc in erat in dui mollis dignissim at id orci. Nullam tempor magna sed tellus iaculis, vitae bibendum nisi consequat. Fusce in dapibus metus. Nulla egestas ipsum nisi, at egestas purus lacinia non. Cras posuere magna sed elit luctus, id accumsan dolor volutpat.

Duis dui est, porta vitae nulla non, elementum luctus lectus. Etiam vel tristique leo. Sed molestie, ligula nec rutrum condimentum, purus velit commodo nibh, sed ornare augue turpis vitae est. Donec suscipit ex lorem, eu viverra nisl dapibus id. Integer dictum vestibulum neque nec dictum. Quisque nec auctor velit. Vestibulum commodo sem at pulvinar laoreet. Nulla vel augue elit. Morbi ut hendrerit turpis. Nullam turpis nibh, ultricies in tincidunt et, euismod non mi.

Sed non eleifend erat. Praesent eu egestas lacus, nec pellentesque ante. Nulla facilisi. Nulla ac tellus ornare, dictum urna nec, elementum velit. Phasellus non malesuada tortor, ac varius neque. Duis euismod velit ex, feugiat ultricies odio semper quis. In id malesuada dui. Aliquam id augue id lectus viverra bibendum eu sit amet sapien. Sed aliquet, dui ac pulvinar convallis, mauris odio sagittis erat, sit amet gravida ante risus quis sapien. Aliquam sapien lacus, faucibus vel blandit non, blandit non ex. In vitae feugiat ipsum. Donec venenatis metus odio, ut consectetur quam pretium in. Vestibulum viverra finibus hendrerit. Cras sem magna, vulputate id ex quis, porttitor pretium lectus.','2019-06-10 16:01:46 EDT','lipsum',1);

DELETE FROM sqlite_sequence;
INSERT INTO "sqlite_sequence" VALUES('post',3);
INSERT INTO "sqlite_sequence" VALUES('user',4);
PRAGMA foreign_keys=ON;
COMMIT;