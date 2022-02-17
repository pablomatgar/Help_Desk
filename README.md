# Help Desk Case Study

Computer system that logs and tracks helpdesk queries. This will also enable analysts to see how the equipment is performing overall, whether the helpdesk specialists are sufficiently resourced to solve problems in an acceptable time, and whether there are subject areas where training should be given to employees. This was the final assignment of the module COM533 - Databases and Web-Based Information Systems in Wrexham Glyndŵr University (United Kingdom).

### Scenario

A company with a large IT function is setting up an IT Helpdesk to handle hardware and software problems concerning the IT systems. Whenever anyone within the company has a problem they can contact the helpdesk. One of the helpdesk operators will attempt to deal with the enquiry, but if an immediate answer cannot be given the problem is passed to one of several specialists.

A computer system is needed to log and track the helpdesk queries. This will enable analysts to see how the equipment is performing overall, whether the helpdesk specialists are sufficiently resourced to solve problems in an acceptable time, and whether there are subject areas where training should be given to employees.

### Proposed System Operation

When a new call comes into the helpdesk the names of the caller and helpdesk operator are logged along with the time of the call, the serial number of the computer and, if relevant, the operating system and software being used. The caller’s name will be checked against a register of all personnel to retrieve the callers' ID number, job title and department. The equipment will also be checked against a register of equipment to find the equipment type and make. The software will be checked to see if it is licensed.

Every call is logged and each problem is given a problem number and this is supplied to the caller so it can be quoted on any subsequent calls about the same problem. The helpdesk operator will also record notes and descriptions of the problem. A reason for each call is always recorded even if it is, in the case of a follow-up call, just a note to say how desperate the caller is getting.

When a problem is first reported the helpdesk operator will also allocate a problem type, selecting it from a list of problem types. It is the skill of the operator to know what problem type is most relevant and how specific the problem is. Some problem types are refinements of more general problem types and so the problem type allocation may be altered at a later time if more information becomes available.

When the problem area is identified the helpdesk operator can lookup previous problems of the same type to see if the problem has occurred before and if so how it was resolved. It is also possible to lookup previous problems with the same equipment or from the same caller to see if there were other related problems.

If the problem can't be solved immediately the helpdesk operator will use the system to look up which specialist to refer the problem too. Each specialist will be an expert in one or more problem types. If there is no specialist listed for a more specific problem type, then a specialist from the more general problem type will be used. The system will also list how many problems the specialist is currently working on so that if there is more than one specialist for a problem type, the specialist who is currently the least loaded can be allocated.

When a problem is eventually resolved, the helpdesk operator or the specialist will log the date and time it is resolved and record some indication of how the problem is resolved and the time taken to resolve the problem. 

At present, the company has a manual paper-based system. Users with problems ring the help desk operator, s/he log the call in a logbook. If s/he can’t resolve it, s/he will manually assign the job to a specialist and update the call log in the logbook. Once the problem is resolved s/he has to manually find the entry in the book and update the details.  The company is facing many issues and delays, sometimes as simple as can’t read the entry in the logbook, takes too long to find the record. Hence the company wanted to update the system to fit the purpose and user friendly.
